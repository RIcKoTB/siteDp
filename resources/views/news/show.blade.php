@extends('layouts.app')

@section('title', $news->title)

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
                    {!! nl2br(e($news->content)) !!}
                @else
                    <p>Контент новини буде додано пізніше.</p>
                @endif
            </div>

            @if($news->gallery && count($news->gallery) > 0)
                <div class="news-gallery">
                    <h3>📸 Галерея</h3>
                    <div class="gallery-grid">
                        @foreach($news->gallery as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Галерея" class="gallery-image">
                        @endforeach
                    </div>
                </div>
            @endif

            @if($news->attachments && count($news->attachments) > 0)
                <div class="news-attachments">
                    <h3>📎 Додані файли</h3>
                    <ul>
                        @foreach($news->attachments as $attachment)
                            <li><a href="{{ asset('storage/' . $attachment) }}" target="_blank">Завантажити файл</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <p style="color: #777;">👁️ Переглядів: {{ $news->views }}</p>

            <!-- Лайки та статистика -->
            <div class="engagement-section" style="margin: 30px 0; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                <div class="engagement-stats" style="display: flex; align-items: center; gap: 20px;">
                    <form action="{{ route('news.like', $news->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="like-button" style="background: linear-gradient(135deg, #ff6b6b, #ee5a52); color: white; border: none; padding: 12px 20px; border-radius: 25px; font-size: 16px; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                            <span>❤️</span>
                            <span>{{ $news->likes_count }}</span>
                            <span>Подобається</span>
                        </button>
                    </form>
                    <div style="display: flex; align-items: center; gap: 8px; color: #666;">
                        <span>💬</span>
                        <span>{{ $news->comments_count }} коментарів</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px; color: #666;">
                        <span>👁️</span>
                        <span>{{ $news->views }} переглядів</span>
                    </div>
                </div>
            </div>

            <hr style="margin: 60px 0;">

            <!-- Форма нового коментаря -->
            <div class="comments-section">
                <h3>💬 Залишити коментар</h3>
                <form action="{{ route('news.comment', $news->id) }}" method="POST" style="margin-bottom: 30px;">
                    @csrf
                    <input type="text" name="author_name" placeholder="Ваше ім'я" required class="form-control" style="margin-bottom: 10px;">
                    <textarea name="content" rows="3" placeholder="Ваш коментар" required class="form-control" style="margin-bottom: 10px;"></textarea>
                    <button type="submit" class="btn btn-primary">Надіслати коментар</button>
                </form>

                <!-- Вивід коментарів -->
                <h3>📝 Коментарі</h3>
                @foreach ($comments as $comment)
                    @include('partials.comment', ['comment' => $comment])
                @endforeach

                <!-- Пагінація коментарів -->
                {{ $comments->links() }}
            </div>
        </div>
    </section>
@endsection
