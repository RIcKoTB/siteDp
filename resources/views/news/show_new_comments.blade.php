@extends('layouts.app')

@section('title', $news->title)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/news-content.css') }}">
    <link rel="stylesheet" href="{{ asset('css/comments-modern.css') }}">
@endpush

@section('content')

    <!-- Hero -->
    <section class="hero" style="background-image: url('{{ $news->img_url }}')">
        <div class="hero-overlay">
            <h1>{{ $news->title }}</h1>
            <p>{{ \Carbon\Carbon::parse($news->date)->format('d F Y') }}</p>
        </div>
    </section>

    <!-- News Content -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">{{ $news->title }}</h2>

            <div class="news-content">
                @if($news->content)
                    {!! $news->content !!}
                @else
                    <p>Контент новини буде додано пізніше.</p>
                @endif
            </div>

            @if(count($news->normalized_gallery) > 0)
                <div class="news-gallery">
                    <h3>📸 Галерея</h3>
                    <div class="gallery-grid">
                        @foreach($news->normalized_gallery as $image)
                            <img src="{{ asset('storage/' . $image['url']) }}" 
                                 alt="{{ $image['alt'] }}" 
                                 class="gallery-image">
                        @endforeach
                    </div>
                </div>
            @endif

            @if(count($news->normalized_attachments) > 0)
                <div class="news-attachments">
                    <h3>📎 Додані файли</h3>
                    <ul>
                        @foreach($news->normalized_attachments as $attachment)
                            @if($attachment['url'])
                                <li><a href="{{ asset('storage/' . $attachment['url']) }}" target="_blank">{{ $attachment['name'] }}</a></li>
                            @else
                                <li><span style="color: #999;">Файл недоступний: {{ $attachment['name'] }}</span></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Like and Comments Stats -->
            <div class="news-stats">
                <div class="stats-container">
                    <button id="like-button" class="like-button" data-news-id="{{ $news->id }}">
                        <span class="like-icon">❤️</span>
                        <span id="likes-count">{{ $news->likes_count }}</span> вподобань
                    </button>
                    <div class="comments-count">
                        💬 {{ $news->comments_count }} коментарів
                    </div>
                    <div class="views-count">
                        👁️ {{ $news->views }} переглядів
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="comments-section">
                <h3>💬 Коментарі</h3>
                
                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        <ul style="margin: 0; padding-left: 1.5rem;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <!-- Comment Form -->
                @auth
                    <div class="comment-form">
                        <h4>Написати коментар</h4>
                        <div class="user-info">
                            <img src="{{ auth()->user()->avatar ?? asset('images/default-avatar.png') }}" alt="Avatar" class="user-avatar">
                            <div>
                                <div class="user-name">{{ auth()->user()->name }}</div>
                                <div class="user-email">{{ auth()->user()->email }}</div>
                                @if(auth()->user()->group)
                                    <span class="user-group">{{ auth()->user()->group }}</span>
                                @endif
                            </div>
                        </div>
                        <form action="{{ route('news.comment', $news->id) }}" method="POST">
                            @csrf
                            <textarea name="content" rows="3" placeholder="Поділіться своїми думками..." required class="form-control"></textarea>
                            <div class="character-counter">0/1000</div>
                            <div style="margin-top: 1rem;">
                                <button type="submit" class="btn btn-primary">Опублікувати</button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="auth-required">
                        <h4>Увійдіть, щоб залишити коментар</h4>
                        <p>Для участі в обговоренні потрібно увійти в систему</p>
                        <a href="{{ route('login') }}" class="btn">Увійти</a>
                    </div>
                @endauth

                <!-- Comments List -->
                <div class="comments-list">
                    @forelse($comments as $comment)
                        <div class="comment-thread">
                            @include('partials.comment', ['comment' => $comment, 'newsId' => $news->id])
                        </div>
                    @empty
                        <div class="no-comments">
                            <p>Поки що немає коментарів. Будьте першим!</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($comments->hasPages())
                    <div style="margin-top: 2rem; text-align: center;">
                        {{ $comments->links() }}
                    </div>
                @endif
            </div>

        </div>
    </section>

@endsection

@push('scripts')
<script>
// Like functionality
document.getElementById('like-button')?.addEventListener('click', function() {
    const newsId = this.dataset.newsId;
    const likesCountElement = document.getElementById('likes-count');
    
    fetch(`/news/${newsId}/like`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        likesCountElement.textContent = data.likes_count;
        
        if (data.liked) {
            this.classList.add('liked');
        } else {
            this.classList.remove('liked');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

// Reply functionality
function toggleReplyForm(commentId) {
    const replyForm = document.getElementById(`reply-form-${commentId}`);
    const replyBtn = document.querySelector(`[onclick="toggleReplyForm(${commentId})"]`);
    
    if (replyForm.classList.contains('active')) {
        replyForm.classList.remove('active');
        replyForm.style.display = 'none';
        replyBtn.textContent = 'Відповісти';
    } else {
        // Hide all other reply forms
        document.querySelectorAll('.reply-form.active').forEach(form => {
            form.classList.remove('active');
            form.style.display = 'none';
        });
        document.querySelectorAll('.reply-btn').forEach(btn => {
            btn.textContent = 'Відповісти';
        });
        
        // Show this reply form
        replyForm.style.display = 'block';
        replyForm.classList.add('active');
        replyBtn.textContent = 'Скасувати';
        
        // Focus on textarea
        setTimeout(() => {
            const textarea = replyForm.querySelector('textarea');
            if (textarea) textarea.focus();
        }, 100);
    }
}

// Character counter
document.addEventListener('DOMContentLoaded', function() {
    const textareas = document.querySelectorAll('textarea[name="content"]');
    
    textareas.forEach(function(textarea) {
        const counter = textarea.parentNode.querySelector('.character-counter');
        if (!counter) return;
        
        function updateCounter() {
            const length = textarea.value.length;
            const maxLength = 1000;
            counter.textContent = `${length}/${maxLength}`;
            
            counter.classList.remove('warning', 'danger');
            if (length > maxLength * 0.9) {
                counter.classList.add('danger');
            } else if (length > maxLength * 0.7) {
                counter.classList.add('warning');
            }
        }
        
        updateCounter();
        textarea.addEventListener('input', updateCounter);
    });
});

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form[action*="/comment"], form[action*="/reply"]');
    
    forms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            const textarea = this.querySelector('textarea[name="content"]');
            const content = textarea.value.trim();
            
            if (content.length === 0) {
                e.preventDefault();
                alert('Коментар не може бути порожнім');
                textarea.focus();
                return false;
            }
            
            if (content.length > 1000) {
                e.preventDefault();
                alert('Коментар не може бути довшим за 1000 символів');
                textarea.focus();
                return false;
            }
        });
    });
});
</script>
@endpush
