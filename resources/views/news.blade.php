@extends('layouts.app')

@section('title', 'Новини коледжу')

@section('content')
    <!-- Hero -->
    <section class="hero" style="background-image: url('/storage/images/1.jpg')">
        <div class="hero-overlay">
            <h1>Новини коледжу</h1>
            <p>Всі самі нові і актуальні новини</p>
        </div>
    </section>

    <!-- News Section -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Всі новини</h2>
            <div class="card-row">
                @foreach ($news as $item)
                    <div class="team-card">
                        <a href="{{ route('news.show', $item->id) }}">
                            <img src="{{ $item->img_url }}" alt="{{ $item->title }}">
                        </a>
                        <div class="card-content">
                            <h3>
                                <a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a>
                            </h3>
                            <p style="font-size: 12px; color: #888;">
                                {{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
