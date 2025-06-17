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

    <!-- Альбом -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">📸 Альбом</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
                @forelse($galleryPhotos as $photo)
                    <div style="position: relative; border-radius: 12px; overflow: hidden; aspect-ratio: 4/3; background: #f5f5f5;">
                        <img src="{{ $photo->image_url }}" alt="{{ $photo->title }}"
                             style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                             onmouseover="this.style.transform='scale(1.05)'"
                             onmouseout="this.style.transform='scale(1)'">
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.7)); color: white; padding: 20px 15px 15px; font-weight: 500;">
                            {{ $photo->title }}
                        </div>
                    </div>
                @empty
                    <!-- Fallback якщо немає фото в галереї -->
                    <div style="position: relative; border-radius: 12px; overflow: hidden; aspect-ratio: 4/3; background: #f5f5f5;">
                        <img src="{{ asset('storage/images/gallery/placeholder.svg') }}" alt="Комп'ютерна аудиторія"
                             style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                             onmouseover="this.style.transform='scale(1.05)'"
                             onmouseout="this.style.transform='scale(1)'">
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.7)); color: white; padding: 20px 15px 15px; font-weight: 500;">
                            Комп'ютерна аудиторія
                        </div>
                    </div>
                    <div style="position: relative; border-radius: 12px; overflow: hidden; aspect-ratio: 4/3; background: #f5f5f5;">
                        <img src="{{ asset('storage/images/gallery/placeholder.svg') }}" alt="Студенти на заняттях"
                             style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                             onmouseover="this.style.transform='scale(1.05)'"
                             onmouseout="this.style.transform='scale(1)'">
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.7)); color: white; padding: 20px 15px 15px; font-weight: 500;">
                            Студенти на заняттях
                        </div>
                    </div>
                    <div style="position: relative; border-radius: 12px; overflow: hidden; aspect-ratio: 4/3; background: #f5f5f5;">
                        <img src="{{ asset('storage/images/gallery/placeholder.svg') }}" alt="Лабораторія"
                             style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                             onmouseover="this.style.transform='scale(1.05)'"
                             onmouseout="this.style.transform='scale(1)'">
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.7)); color: white; padding: 20px 15px 15px; font-weight: 500;">
                            Лабораторія
                        </div>
                    </div>
                    <div style="position: relative; border-radius: 12px; overflow: hidden; aspect-ratio: 4/3; background: #f5f5f5;">
                        <img src="{{ asset('storage/images/gallery/placeholder.svg') }}" alt="Випуск студентів"
                             style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                             onmouseover="this.style.transform='scale(1.05)'"
                             onmouseout="this.style.transform='scale(1)'">
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.7)); color: white; padding: 20px 15px 15px; font-weight: 500;">
                            Випуск студентів
                        </div>
                    </div>
                @endforelse
            </div>
            <div style="text-align: center;">
                <a href="/gallery" class="btn btn-secondary">Переглянути всі фото</a>
            </div>
        </div>
    </section>

    <!-- Де ми знаходимось -->
    <section class="section alt-bg">
        <div class="container">
            <h2 class="section-title">📍 Де ми знаходимось</h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start;" class="location-grid">
                <div class="location-info">
                    <div style="display: flex; align-items: start; gap: 15px; margin-bottom: 25px;">
                        <div style="font-size: 24px; margin-top: 5px;">🏢</div>
                        <div>
                            <h4 style="margin: 0 0 8px 0; font-size: 18px; color: #333;">Адреса</h4>
                            <p style="margin: 0; color: #666; line-height: 1.5;">
                                {{ $contactSettings['address_street'] ?? 'вул. Університетська, 14' }}<br>
                                {{ $contactSettings['address_city'] ?? 'м. Ужгород' }}, {{ $contactSettings['address_region'] ?? 'Закарпатська область' }}, {{ $contactSettings['address_postal_code'] ?? '88000' }}
                            </p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: start; gap: 15px; margin-bottom: 25px;">
                        <div style="font-size: 24px; margin-top: 5px;">📞</div>
                        <div>
                            <h4 style="margin: 0 0 8px 0; font-size: 18px; color: #333;">Телефон</h4>
                            <p style="margin: 0; color: #666;">{{ $contactSettings['phone'] ?? '+38 (0312) 61-18-05' }}</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: start; gap: 15px;">
                        <div style="font-size: 24px; margin-top: 5px;">✉️</div>
                        <div>
                            <h4 style="margin: 0 0 8px 0; font-size: 18px; color: #333;">Email</h4>
                            <p style="margin: 0; color: #666;">{{ $contactSettings['email'] ?? 'info@uzhnu.edu.ua' }}</p>
                        </div>
                    </div>
                </div>
                <div class="location-map">
                    <!-- Інтерактивна карта через OpenStreetMap -->
                    <div id="map" style="width: 100%; height: 300px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); background: #f8f9fa;"></div>

                    <!-- Fallback iframe якщо Leaflet не працює -->
                    <iframe id="map-fallback"
                        src="https://maps.google.com/maps?q={{ $contactSettings['map_latitude'] ?? '48.6134116' }},{{ $contactSettings['map_longitude'] ?? '22.3066565' }}&hl=uk&z={{ $contactSettings['map_zoom'] ?? '15' }}&output=embed"
                        width="100%"
                        height="300"
                        style="border:0; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); display: none;"
                        allowfullscreen=""
                        loading="lazy"
                        title="Карта розташування ЦК ПІТ">
                    </iframe>
                </div>
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

@section('scripts')
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

<script>
// Ініціалізація карти
document.addEventListener('DOMContentLoaded', function() {
    try {
        // Координати з налаштувань
        const latitude = {{ $contactSettings['map_latitude'] ?? '48.6134116' }};
        const longitude = {{ $contactSettings['map_longitude'] ?? '22.3066565' }};
        const zoom = {{ $contactSettings['map_zoom'] ?? '15' }};

        // Створюємо карту
        const map = L.map('map').setView([latitude, longitude], zoom);

        // Додаємо тайли OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);

        // Створюємо кастомну іконку
        const customIcon = L.divIcon({
            html: `
                <div style="
                    background: #007bff;
                    width: 30px;
                    height: 30px;
                    border-radius: 50%;
                    border: 3px solid white;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 16px;
                    color: white;
                ">🏫</div>
            `,
            className: 'custom-marker',
            iconSize: [36, 36],
            iconAnchor: [18, 18]
        });

        // Додаємо маркер
        const marker = L.marker([latitude, longitude], { icon: customIcon }).addTo(map);

        // Додаємо popup
        marker.bindPopup(`
            <div style="padding: 10px; font-family: Arial, sans-serif;">
                <h4 style="margin: 0 0 8px 0; color: #333; font-size: 16px;">ЦК ПІТ</h4>
                <p style="margin: 0 0 6px 0; font-size: 14px; color: #555;">{{ $contactSettings['organization_name'] ?? 'Циклова комісія програмування та інформаційних технологій' }}</p>
                <p style="margin: 0 0 6px 0; font-size: 13px; color: #666;">📍 {{ $contactSettings['address_street'] ?? 'вул. Українська, 19' }}, {{ $contactSettings['address_city'] ?? 'Ужгород' }}</p>
                <p style="margin: 0; font-size: 13px; color: #666;">📞 {{ $contactSettings['phone'] ?? '+38 (0312) 61-33-45' }}</p>
            </div>
        `);

        // Відкриваємо popup автоматично
        marker.openPopup();

        console.log('Leaflet карта успішно завантажена');

    } catch (error) {
        console.error('Помилка завантаження Leaflet карти:', error);
        showMapFallback();
    }
});

// Функція для показу fallback карти
function showMapFallback() {
    const mapElement = document.getElementById('map');
    const fallbackElement = document.getElementById('map-fallback');

    if (mapElement && fallbackElement) {
        mapElement.style.display = 'none';
        fallbackElement.style.display = 'block';
        console.log('Показуємо fallback карту');
    }
}

// Адаптивність для мобільних пристроїв
window.addEventListener('resize', function() {
    const locationGrid = document.querySelector('.location-grid');
    if (window.innerWidth <= 768) {
        locationGrid.style.gridTemplateColumns = '1fr';
        locationGrid.style.gap = '30px';
    } else {
        locationGrid.style.gridTemplateColumns = '1fr 1fr';
        locationGrid.style.gap = '40px';
    }
});

// Таймаут для fallback якщо Leaflet не завантажився
setTimeout(function() {
    if (typeof L === 'undefined') {
        console.warn('Leaflet не завантажився, показуємо fallback карту');
        showMapFallback();
    }
}, 5000);
</script>

<style>
/* Стилі для карти */
#map {
    z-index: 1;
}

.leaflet-popup-content-wrapper {
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.leaflet-popup-tip {
    background: white;
}

.custom-marker {
    background: transparent !important;
    border: none !important;
}

/* Адаптивні стилі для карти */
@media (max-width: 768px) {
    .location-grid {
        grid-template-columns: 1fr !important;
        gap: 30px !important;
    }

    .location-info {
        order: 2;
    }

    .location-map {
        order: 1;
    }

    #map, #map-fallback {
        height: 250px !important;
    }
}

@media (max-width: 480px) {
    .section-title {
        font-size: 24px;
    }

    #map, #map-fallback {
        height: 200px !important;
    }
}
</style>

<style>
/* Адаптивні стилі для альбому та карти */
@media (max-width: 768px) {
    .location-grid {
        grid-template-columns: 1fr !important;
        gap: 30px !important;
    }

    .location-info {
        order: 2;
    }

    .location-map {
        order: 1;
    }

    #map {
        height: 250px !important;
    }
}

@media (max-width: 480px) {
    .section-title {
        font-size: 24px;
    }

    .hero h1 {
        font-size: 28px;
    }

    .hero p {
        font-size: 16px;
    }
}
</style>
@endsection
