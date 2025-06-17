@extends('layouts.app')

@section('title', 'Новини коледжу')

@section('content')
<div class="news-page">
    <!-- Hero Section -->
    <section class="news-hero">
        <div class="hero-background">
            <div class="hero-particles"></div>
            <div class="hero-gradient"></div>
        </div>
        <div class="container">
            <div class="hero-content" data-aos="fade-up">
                <div class="hero-badge">
                    <span class="badge-icon">📰</span>
                    <span class="badge-text">Новини</span>
                </div>
                <h1 class="hero-title">Останні новини коледжу</h1>
                <p class="hero-subtitle">Слідкуйте за найважливішими подіями та оновленнями нашого навчального закладу</p>
                <div class="hero-stats">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                        <span class="stat-number">{{ $news->total() }}</span>
                        <span class="stat-label">Новин</span>
                    </div>
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                        <span class="stat-number">{{ date('Y') }}</span>
                        <span class="stat-label">Рік</span>
                    </div>
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                        <span class="stat-number">{{ date('m') }}</span>
                        <span class="stat-label">Місяць</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-scroll-indicator">
            <div class="scroll-arrow"></div>
        </div>
    </section>

    <!-- News Grid Section -->
    <section class="news-section">
        <div class="container">
            <!-- Filter Tabs -->
            <div class="news-filters" data-aos="fade-up">
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
            <div class="news-grid" id="newsGrid">
                @foreach ($news as $index => $item)
                    <article class="news-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="card-image-wrapper">
                            <img src="{{ $item->img_url }}" alt="{{ $item->title }}" class="card-image" loading="lazy">
                            <div class="card-overlay">
                                <div class="card-date">
                                    <span class="date-day">{{ \Carbon\Carbon::parse($item->date)->format('d') }}</span>
                                    <span class="date-month">{{ \Carbon\Carbon::parse($item->date)->translatedFormat('M') }}</span>
                                </div>
                                <div class="card-category">
                                    <span class="category-badge">Новини</span>
                                </div>
                            </div>
                            <div class="card-hover-overlay">
                                <a href="{{ route('news.show', $item->id) }}" class="read-more-btn">
                                    <span class="btn-icon">👁️</span>
                                    <span class="btn-text">Читати</span>
                                </a>
                            </div>
                        </div>

                        <div class="card-content">
                            <div class="card-meta">
                                <span class="meta-date">
                                    <span class="meta-icon">📅</span>
                                    {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}
                                </span>
                                <span class="meta-reading-time">
                                    <span class="meta-icon">⏱️</span>
                                    {{ rand(2, 5) }} хв читання
                                </span>
                            </div>

                            <h3 class="card-title">
                                <a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a>
                            </h3>

                            <p class="card-excerpt">
                                {{ Str::limit($item->content ?? 'Цікава новина про життя нашого коледжу. Дізнайтеся більше деталей, перейшовши за посиланням.', 120) }}
                            </p>

                            <div class="card-footer">
                                <a href="{{ route('news.show', $item->id) }}" class="card-link">
                                    <span class="link-text">Детальніше</span>
                                    <span class="link-arrow">→</span>
                                </a>
                                <div class="card-actions">
                                    <button class="action-btn like-btn" title="Подобається">
                                        <span class="action-icon">❤️</span>
                                        <span class="action-count">{{ rand(5, 25) }}</span>
                                    </button>
                                    <button class="action-btn share-btn" title="Поділитися">
                                        <span class="action-icon">📤</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Load More Button -->
            @if($news->hasMorePages())
                <div class="load-more-section" data-aos="fade-up">
                    <button class="load-more-btn" id="loadMoreBtn">
                        <span class="btn-spinner"></span>
                        <span class="btn-text">Завантажити ще</span>
                        <span class="btn-icon">⬇️</span>
                    </button>
                </div>
            @endif

            <!-- Pagination -->
            <div class="pagination-wrapper" data-aos="fade-up">
                {{ $news->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section" data-aos="fade-up">
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
</div>
@endsection

@section('scripts')
<!-- AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<style>
/* News Page Styles */
.news-page {
    background: #f8fafc;
    min-height: 100vh;
}

/* Hero Section */
.news-hero {
    position: relative;
    height: 70vh;
    min-height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.hero-particles {
    position: absolute;
    width: 100%;
    height: 100%;
    background-image:
        radial-gradient(2px 2px at 20px 30px, rgba(255,255,255,0.3), transparent),
        radial-gradient(2px 2px at 40px 70px, rgba(255,255,255,0.2), transparent),
        radial-gradient(1px 1px at 90px 40px, rgba(255,255,255,0.4), transparent),
        radial-gradient(1px 1px at 130px 80px, rgba(255,255,255,0.3), transparent);
    background-repeat: repeat;
    background-size: 200px 100px;
    animation: particleFloat 20s linear infinite;
}

@keyframes particleFloat {
    0% { transform: translateY(0px) translateX(0px); }
    33% { transform: translateY(-10px) translateX(10px); }
    66% { transform: translateY(5px) translateX(-5px); }
    100% { transform: translateY(0px) translateX(0px); }
}

.hero-gradient {
    position: absolute;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, rgba(0,0,0,0.1) 0%, rgba(255,255,255,0.1) 100%);
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: white;
    max-width: 800px;
    padding: 0 20px;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    padding: 8px 16px;
    border-radius: 50px;
    margin-bottom: 20px;
    border: 1px solid rgba(255,255,255,0.3);
    animation: badgePulse 3s ease-in-out infinite;
}

@keyframes badgePulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.badge-icon {
    font-size: 18px;
    animation: iconRotate 4s linear infinite;
}

@keyframes iconRotate {
    0% { transform: rotate(0deg); }
    25% { transform: rotate(-5deg); }
    75% { transform: rotate(5deg); }
    100% { transform: rotate(0deg); }
}

.badge-text {
    font-weight: 600;
    font-size: 14px;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 20px;
    background: linear-gradient(45deg, #fff, #e2e8f0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: titleGlow 3s ease-in-out infinite alternate;
}

@keyframes titleGlow {
    0% { text-shadow: 0 0 20px rgba(255,255,255,0.5); }
    100% { text-shadow: 0 0 30px rgba(255,255,255,0.8); }
}

.hero-subtitle {
    font-size: 1.2rem;
    margin-bottom: 40px;
    opacity: 0.9;
    line-height: 1.6;
}

.hero-stats {
    display: flex;
    justify-content: center;
    gap: 40px;
    margin-top: 40px;
}

.stat-item {
    text-align: center;
    padding: 20px;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    border: 1px solid rgba(255,255,255,0.2);
    transition: transform 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
}

.stat-number {
    display: block;
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 5px;
    animation: numberCount 2s ease-out;
}

@keyframes numberCount {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.hero-scroll-indicator {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 2;
}

.scroll-arrow {
    width: 30px;
    height: 30px;
    border: 2px solid rgba(255,255,255,0.7);
    border-top: none;
    border-left: none;
    transform: rotate(45deg);
    animation: scrollBounce 2s infinite;
}

@keyframes scrollBounce {
    0%, 20%, 50%, 80%, 100% { transform: rotate(45deg) translateY(0); }
    40% { transform: rotate(45deg) translateY(-10px); }
    60% { transform: rotate(45deg) translateY(-5px); }
}

/* News Section */
.news-section {
    padding: 80px 0;
    background: #f8fafc;
}

/* Filter Tabs */
.news-filters {
    margin-bottom: 60px;
    text-align: center;
}

.filter-tabs {
    display: inline-flex;
    background: white;
    border-radius: 15px;
    padding: 8px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    gap: 4px;
}

.filter-tab {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    border: none;
    background: transparent;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
    color: #64748b;
}

.filter-tab:hover {
    background: #f1f5f9;
    transform: translateY(-2px);
}

.filter-tab.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.tab-icon {
    font-size: 16px;
    animation: tabIconBounce 2s ease-in-out infinite;
}

@keyframes tabIconBounce {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

.tab-text {
    font-size: 14px;
}

/* News Grid */
.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin-bottom: 60px;
}

.news-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: all 0.4s ease;
    position: relative;
}

.news-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
}

.card-image-wrapper {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.card-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.news-card:hover .card-image {
    transform: scale(1.1);
}

.card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(0,0,0,0.3) 0%, transparent 50%);
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 20px;
}

.card-date {
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    padding: 8px 12px;
    text-align: center;
    animation: dateFloat 3s ease-in-out infinite;
}

@keyframes dateFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.date-day {
    display: block;
    font-size: 18px;
    font-weight: 800;
    color: #1e293b;
    line-height: 1;
}

.date-month {
    display: block;
    font-size: 12px;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.category-badge {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    animation: badgeGlow 2s ease-in-out infinite alternate;
}

@keyframes badgeGlow {
    0% { box-shadow: 0 0 10px rgba(102, 126, 234, 0.5); }
    100% { box-shadow: 0 0 20px rgba(102, 126, 234, 0.8); }
}

.card-hover-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.news-card:hover .card-hover-overlay {
    opacity: 1;
}

.read-more-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    background: white;
    color: #1e293b;
    padding: 12px 20px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.news-card:hover .read-more-btn {
    transform: translateY(0);
}

.read-more-btn:hover {
    background: #667eea;
    color: white;
    transform: scale(1.05);
}

/* Card Content */
.card-content {
    padding: 25px;
}

.card-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    font-size: 12px;
    color: #64748b;
}

.meta-date, .meta-reading-time {
    display: flex;
    align-items: center;
    gap: 4px;
}

.meta-icon {
    font-size: 14px;
}

.card-title {
    margin-bottom: 15px;
    line-height: 1.4;
}

.card-title a {
    color: #1e293b;
    text-decoration: none;
    font-size: 18px;
    font-weight: 700;
    transition: color 0.3s ease;
}

.card-title a:hover {
    color: #667eea;
}

.card-excerpt {
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 20px;
    font-size: 14px;
}

.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 20px;
    border-top: 1px solid #f1f5f9;
}

.card-link {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
}

.card-link:hover {
    color: #4f46e5;
    transform: translateX(5px);
}

.link-arrow {
    transition: transform 0.3s ease;
}

.card-link:hover .link-arrow {
    transform: translateX(3px);
}

.card-actions {
    display: flex;
    gap: 10px;
}

.action-btn {
    display: flex;
    align-items: center;
    gap: 4px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 6px 10px;
    border-radius: 20px;
    transition: all 0.3s ease;
    font-size: 12px;
}

.like-btn:hover {
    background: #fef2f2;
    color: #dc2626;
}

.share-btn:hover {
    background: #f0f9ff;
    color: #0284c7;
}

.action-icon {
    font-size: 14px;
}

.action-count {
    font-weight: 600;
}

/* Load More Button */
.load-more-section {
    text-align: center;
    margin-bottom: 40px;
}

.load-more-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.load-more-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
}

.load-more-btn:active {
    transform: translateY(0);
}

.btn-spinner {
    width: 16px;
    height: 16px;
    border: 2px solid rgba(255,255,255,0.3);
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    display: none;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.load-more-btn.loading .btn-spinner {
    display: block;
}

.load-more-btn.loading .btn-text,
.load-more-btn.loading .btn-icon {
    display: none;
}

/* Newsletter Section */
.newsletter-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.newsletter-card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 60px 40px;
    text-align: center;
    border: 1px solid rgba(255,255,255,0.2);
}

.newsletter-icon {
    font-size: 48px;
    margin-bottom: 20px;
    animation: iconFloat 3s ease-in-out infinite;
}

@keyframes iconFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.newsletter-title {
    color: white;
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 15px;
}

.newsletter-text {
    color: rgba(255,255,255,0.9);
    font-size: 1.1rem;
    margin-bottom: 40px;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

.newsletter-form {
    max-width: 400px;
    margin: 0 auto;
}

.form-group {
    display: flex;
    gap: 10px;
    background: rgba(255,255,255,0.1);
    padding: 8px;
    border-radius: 50px;
    border: 1px solid rgba(255,255,255,0.2);
}

.form-input {
    flex: 1;
    background: none;
    border: none;
    padding: 12px 20px;
    color: white;
    font-size: 16px;
    outline: none;
}

.form-input::placeholder {
    color: rgba(255,255,255,0.7);
}

.form-submit {
    display: flex;
    align-items: center;
    gap: 8px;
    background: white;
    color: #667eea;
    border: none;
    padding: 12px 24px;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.form-submit:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Pagination */
.pagination-wrapper {
    text-align: center;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }

    .hero-stats {
        flex-direction: column;
        gap: 20px;
    }

    .filter-tabs {
        flex-wrap: wrap;
        justify-content: center;
    }

    .news-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .card-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }

    .newsletter-card {
        padding: 40px 20px;
    }

    .newsletter-title {
        font-size: 2rem;
    }

    .form-group {
        flex-direction: column;
        gap: 15px;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 2rem;
    }

    .news-grid {
        grid-template-columns: 1fr;
    }

    .card-footer {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
}
</style>

<script>
// Initialize AOS
AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true,
    offset: 100
});

// Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterTabs = document.querySelectorAll('.filter-tab');
    const newsCards = document.querySelectorAll('.news-card');

    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            filterTabs.forEach(t => t.classList.remove('active'));
            // Add active class to clicked tab
            this.classList.add('active');

            const filter = this.dataset.filter;

            // Filter news cards (for now just show all)
            newsCards.forEach(card => {
                card.style.display = 'block';
                // Add animation
                card.style.animation = 'none';
                setTimeout(() => {
                    card.style.animation = 'fadeInUp 0.6s ease forwards';
                }, 100);
            });
        });
    });

    // Load more functionality
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            this.classList.add('loading');

            // Simulate loading
            setTimeout(() => {
                this.classList.remove('loading');
                // Here you would typically load more news via AJAX
            }, 2000);
        });
    }

    // Like button functionality
    document.querySelectorAll('.like-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const icon = this.querySelector('.action-icon');
            const count = this.querySelector('.action-count');

            // Toggle like
            if (icon.textContent === '❤️') {
                icon.textContent = '💖';
                count.textContent = parseInt(count.textContent) + 1;
                this.style.color = '#dc2626';
            } else {
                icon.textContent = '❤️';
                count.textContent = parseInt(count.textContent) - 1;
                this.style.color = '';
            }
        });
    });

    // Share button functionality
    document.querySelectorAll('.share-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Simple share functionality
            if (navigator.share) {
                navigator.share({
                    title: 'Новина з коледжу',
                    url: window.location.href
                });
            } else {
                // Fallback - copy to clipboard
                navigator.clipboard.writeText(window.location.href);
                alert('Посилання скопійовано!');
            }
        });
    });
});

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);
</script>
@endsection
