@extends('layouts.app')

@section('title', $news->title)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/news-content.css') }}">
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
                
                <!-- Comment Form -->
                <div class="comment-form">
                    <h4>Залишити коментар</h4>
                    <form action="{{ route('news.comment', $news->id) }}" method="POST">
                        @csrf
                        <input type="text" name="author_name" placeholder="Ваше ім'я" required class="form-control" style="margin-bottom: 10px;">
                        <textarea name="content" rows="3" placeholder="Ваш коментар" required class="form-control" style="margin-bottom: 10px;"></textarea>
                        <button type="submit" class="btn btn-primary">Надіслати коментар</button>
                    </form>
                </div>

                <!-- Comments List -->
                <div class="comments-list">
                    @forelse($comments as $comment)
                        <div class="comment">
                            <div class="comment-header">
                                <strong>{{ $comment->author_name }}</strong>
                                <span class="comment-date">{{ $comment->created_at->format('d.m.Y H:i') }}</span>
                            </div>
                            <div class="comment-content">{{ $comment->content }}</div>
                            
                            <!-- Reply Button -->
                            <button class="reply-button" onclick="toggleReplyForm({{ $comment->id }})">Відповісти</button>
                            
                            <!-- Reply Form -->
                            <div id="reply-form-{{ $comment->id }}" class="reply-form" style="display: none;">
                                <form action="{{ route('news.reply', $news->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <input type="text" name="author_name" placeholder="Ваше ім'я" required class="form-control" style="margin-bottom: 5px;">
                                    <textarea name="content" rows="2" placeholder="Ваша відповідь" required class="form-control" style="margin-bottom: 5px;"></textarea>
                                    <button type="submit" class="btn btn-sm btn-secondary">Відповісти</button>
                                    <button type="button" class="btn btn-sm btn-light" onclick="toggleReplyForm({{ $comment->id }})">Скасувати</button>
                                </form>
                            </div>

                            <!-- Replies -->
                            @if($comment->replies->count() > 0)
                                <div class="replies">
                                    @foreach($comment->replies as $reply)
                                        <div class="reply">
                                            <div class="comment-header">
                                                <strong>{{ $reply->author_name }}</strong>
                                                <span class="comment-date">{{ $reply->created_at->format('d.m.Y H:i') }}</span>
                                            </div>
                                            <div class="comment-content">{{ $reply->content }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="no-comments">Поки що немає коментарів. Будьте першим!</p>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($comments->hasPages())
                    <div class="pagination-wrapper">
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
document.getElementById('like-button').addEventListener('click', function() {
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

// Reply form toggle
function toggleReplyForm(commentId) {
    const replyForm = document.getElementById(`reply-form-${commentId}`);
    if (replyForm.style.display === 'none') {
        replyForm.style.display = 'block';
    } else {
        replyForm.style.display = 'none';
    }
}
</script>
@endpush
