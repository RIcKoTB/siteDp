@extends('layouts.app')

@section('title', 'Головна')

@section('content')
    <!-- Hero -->
    <section class="hero" style="background-image: url('/storage/images/1.jpg')">
        <div class="hero-overlay">
            <h1>Циклова комісія програмування та інформаційних технологій</h1>
            <p>Наша мета — якісна освіта та підготовка фахівців для ІТ-сфери</p>
        </div>
    </section>

    <!-- About -->
    <section class="section alt-bg">
        <div class="container">
            <h2 class="section-title">Про нас</h2>
            <p class="section-text">
                Ми — команда викладачів, які навчають майбутніх програмістів. На нашій сторінці ви знайдете освітні програми, практичні матеріали, проєкти студентів, новини та багато іншого.
            </p>
        </div>
    </section>

    <!-- Last News -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">📰 Останні новини</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                @foreach ($latestNews as $item)
                    <div style="
                    background: #ffffff;
                    border-radius: 16px;
                    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
                    overflow: hidden;
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                " onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 12px 28px rgba(0,0,0,0.12)'"
                         onmouseout="this.style.transform='none'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.08)'">
                        <a href="{{ route('news.show', $item->id) }}">
                            <img src="{{ $item->img_url }}" alt="{{ $item->title }}" style="width: 100%; height: 200px; object-fit: cover;">
                        </a>
                        <div style="padding: 20px;">
                            <h3 style="margin-bottom: 12px; font-size: 18px;">
                                <a href="{{ route('news.show', $item->id) }}" style="color: #222; text-decoration: none;">
                                    {{ $item->title }}
                                </a>
                            </h3>
                            <p style="color: #888; font-size: 13px; margin-bottom: 16px;">
                                {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}
                            </p>
                            <a href="{{ route('news.show', $item->id) }}" style="
                            color: #1a73e8;
                            font-weight: 600;
                            font-size: 14px;
                            text-decoration: none;
                        ">Детальніше →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>



    <!-- Call to Action -->
    <!-- Call to Action -->
    <section class="section alt-bg">
        <div class="container text-center" style="padding: 40px 20px;">
            <h2 class="section-title">Приєднуйся до нашої спільноти</h2>
            <p class="section-text" style="max-width: 700px; margin: 0 auto;">
                Хочеш навчатись програмуванню, брати участь у проєктах, хакатонах, конференціях? Ми чекаємо саме тебе!
            </p>
            <a href="/contact" class="btn btn-primary" style="margin: 25px auto 0; padding: 12px 24px; font-size: 16px; display: block; width: fit-content;">
                Зв'язатися з нами
            </a>
        </div>
    </section>


@endsection
