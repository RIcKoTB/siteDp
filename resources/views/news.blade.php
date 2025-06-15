@extends('layouts.app')

@section('title', 'Новини коледжу')

@section('content')
    <!-- Hero -->
    <section class="hero" style="background-image: url('/storage/images/1.jpg')">
        <div class="hero-overlay">
            <h1>Новини коледжу</h1>
            <p>Всі найсвіжіші та актуальні новини</p>
        </div>
    </section>

    <!-- News Section -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">📰 Всі новини</h2>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                @foreach ($news as $item)
                    <div style="
                        background: #fff;
                        border-radius: 12px;
                        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
                        overflow: hidden;
                        transition: transform 0.3s ease;
                    " onmouseover="this.style.transform='translateY(-5px)'"
                         onmouseout="this.style.transform='none'">
                        <a href="{{ route('news.show', $item->id) }}">
                            <img src="{{ $item->img_url }}" alt="{{ $item->title }}" style="width: 100%; height: 200px; object-fit: cover;">
                        </a>
                        <div style="padding: 18px;">
                            <h3 style="margin-bottom: 10px;">
                                <a href="{{ route('news.show', $item->id) }}" style="color: #222; text-decoration: none;">
                                    {{ $item->title }}
                                </a>
                            </h3>
                            <p style="color: #777; font-size: 13px; margin-bottom: 10px;">
                                {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}
                            </p>
                            <a href="{{ route('news.show', $item->id) }}" style="color: #007bff; font-weight: bold; font-size: 14px;">
                                Детальніше →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div style="margin-top: 40px; text-align: center;">
                {{ $news->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
@endsection
