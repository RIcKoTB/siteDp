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
                <h3>Тестовий контент</h3>
                <p>Це тестовий контент для перевірки відображення.</p>
                
                @if($news->content)
                    <h4>Контент з бази даних:</h4>
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

        </div>
    </section>

@endsection
