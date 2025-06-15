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
                {!! $news->content !!}
            </div>


        @if ($news->gallery && is_array($news->gallery))
                <div class="news-gallery" style="margin-top: 50px;">
                    <h3>🖼️ Фотогалерея</h3>
                    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                        @foreach ($news->gallery as $item)
                            <div style="flex: 1 1 250px;">
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="Фото" style="width: 100%; border-radius: 8px;">
                                @if (!empty($item['caption']))
                                    <p style="text-align: center; font-style: italic; color: #555;">{{ $item['caption'] }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (!empty($news->attachments) && is_array($news->attachments))
                <div class="news-attachments" style="margin-top: 40px;">
                    <h3>📎 Прикріплені файли</h3>
                    <ul style="padding-left: 20px;">
                        @foreach ($news->attachments as $attachment)
                            <li style="margin-bottom: 8px;">
                                <a href="{{ asset('storage/' . $attachment['file']) }}" target="_blank" style="color: #1e40af; text-decoration: underline;">
                                    {{ basename($attachment['file']) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif



            <p style="color: #777;">👁️ Переглядів: {{ $news->views }}</p>

            <hr style="margin: 60px 0;">

            <!-- Форма нового коментаря -->
            <div class="comments-section">
                <h3>💬 Залишити коментар</h3>
                <form action="{{ route('news.comment', $news->id) }}" method="POST" style="margin-bottom: 30px;">
                    @csrf
                    <input type="text" name="author_name" placeholder="Ваше ім’я" required class="form-control" style="margin-bottom: 10px;">
                    <textarea name="content" rows="3" placeholder="Ваш коментар" required class="form-control" style="margin-bottom: 10px;"></textarea>
                    <button type="submit" class="btn btn-primary">Надіслати коментар</button>
                </form>

                <!-- Вивід коментарів -->
                <h3>📝 Коментарі</h3>
                @foreach ($comments as $comment)
                    @include('partials.comment', ['comment' => $comment])
                @endforeach
            </div>
        </div>
    </section>
@endsection
