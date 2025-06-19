@extends('layouts.app')

@section('title', 'Новини')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/news.css') }}">
@endpush

@section('content')
    <!-- Hero Section with Animation -->
    <section class="news-hero">
        <div class="hero-background">
            <div class="hero-particles"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="badge-icon">📰</span>
                    <span class="badge-text">Новини коледжу</span>
                </div>
                <h1 class="hero-title">Останні новини та події</h1>
                <p class="hero-subtitle">Слідкуйте за найважливішими подіями та оновленнями нашого навчального закладу</p>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">{{ $news->total() }}</span>
                        <span class="stat-label">Новин</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ date('Y') }}</span>
                        <span class="stat-label">Рік</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ date('m') }}</span>
                        <span class="stat-label">Місяць</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <div class="scroll-arrow"></div>
        </div>
    </section>

    <!-- News Grid Section -->
    <section class="news-section">
        <div class="container">
            <!-- Filter Tabs -->
            <div class="filter-section">
                <div class="filter-tabs">
                    <button class="filter-tab active" data-filter="all">
                        <span class="tab-icon">📋</span>
                        <span class="tab-text">Всі новини</span>
                    </button>
                    <button class="filter-tab" data-filter="events">
                        <span class="tab-icon">🎉</span>
                        <span class="tab-text">Події</span>
                    </button>
                    <button class="filter-tab" data-filter="achievements">
                        <span class="tab-icon">🏆</span>
                        <span class="tab-text">Досягнення</span>
                    </button>
                    <button class="filter-tab" data-filter="announcements">
                        <span class="tab-icon">📢</span>
                        <span class="tab-text">Оголошення</span>
                    </button>
                </div>
            </div>

            <!-- News Grid -->
            <div class="news-grid">
                @forelse ($news as $index => $item)
                    <article class="news-card" data-index="{{ $index }}">
                        <div class="card-inner">
                            <!-- Image Section -->
                            <div class="card-image-wrapper">
                                <img src="{{ $item->img_url }}" alt="{{ $item->title }}" class="card-image">
                                <div class="image-overlay">
                                    <div class="overlay-content">
                                        <div class="card-badges">
                                            <span class="badge badge-category">📰 Новини</span>
                                            <span class="badge badge-date">
                                                <span class="date-day">{{ \Carbon\Carbon::parse($item->date)->format('d') }}</span>
                                                <span class="date-month">{{ \Carbon\Carbon::parse($item->date)->translatedFormat('M') }}</span>
                                            </span>
                                        </div>
                                        <div class="card-actions">
                                            <button class="action-btn bookmark-btn" title="Зберегти">
                                                <i class="icon">🔖</i>
                                            </button>
                                            <button class="action-btn share-btn" title="Поділитися">
                                                <i class="icon">📤</i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="read-overlay">
                                        <a href="{{ route('news.show', $item->id) }}" class="read-btn">
                                            <span class="btn-icon">👁️</span>
                                            <span class="btn-text">Читати статтю</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Section -->
                            <div class="card-content">
                                <div class="content-meta">
                                    <div class="meta-items">
                                        <span class="meta-item">
                                            <i class="meta-icon">📅</i>
                                            <span class="meta-text">{{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}</span>
                                        </span>
                                        @if($item->views)
                                            <span class="meta-item">
                                                <i class="meta-icon">👁️</i>
                                                <span class="meta-text">{{ $item->views }}</span>
                                            </span>
                                        @endif
                                        <span class="meta-item">
                                            <i class="meta-icon">⏱️</i>
                                            <span class="meta-text">{{ rand(2, 5) }} хв</span>
                                        </span>
                                    </div>
                                </div>

                                <h3 class="card-title">
                                    <a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a>
                                </h3>

                                <p class="card-excerpt">
                                    {{ Str::limit($item->content ?? 'Цікава новина про життя нашого коледжу. Дізнайтеся більше деталей про події, досягнення та важливі оновлення.', 140) }}
                                </p>

                                <div class="card-footer">
                                    <a href="{{ route('news.show', $item->id) }}" class="read-more-link">
                                        <span class="link-text">Детальніше</span>
                                        <span class="link-arrow">→</span>
                                    </a>
                                    <div class="engagement-stats">
                                        <button class="stat-btn like-btn">
                                            <i class="stat-icon">❤️</i>
                                            <span class="stat-count">{{ rand(5, 25) }}</span>
                                        </button>
                                        <button class="stat-btn comment-btn">
                                            <i class="stat-icon">💬</i>
                                            <span class="stat-count">{{ rand(0, 8) }}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="no-news-container">
                        <div class="no-news">
                            <div class="no-news-animation">
                                <div class="news-icon">📰</div>
                                <div class="floating-dots">
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                    <span class="dot"></span>
                                </div>
                            </div>
                            <h3 class="no-news-title">Поки що немає новин</h3>
                            <p class="no-news-text">Слідкуйте за оновленнями - незабаром з'являться цікаві новини!</p>
                            <button class="refresh-btn" onclick="window.location.reload()">
                                <span class="refresh-icon">🔄</span>
                                <span class="refresh-text">Оновити</span>
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($news->hasPages())
                <div class="pagination-wrapper">
                    {{ $news->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-card">
                <div class="newsletter-content">
                    <div class="newsletter-icon">📧</div>
                    <h3 class="newsletter-title">Підпишіться на новини</h3>
                    <p class="newsletter-text">Отримуйте найсвіжіші новини коледжу прямо на вашу електронну пошту</p>
                    <form class="newsletter-form">
                        <div class="form-group">
                            <input type="email" class="form-input" placeholder="Ваша електронна пошта" required>
                            <button type="submit" class="form-submit">
                                <span class="submit-text">Підписатися</span>
                                <span class="submit-icon">✉️</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="{{ asset('js/news.js') }}"></script>
@endpush
