@extends('layouts.app')

@section('title', $news->title)

@section('content')
    <!-- Hero Section -->
    <section class="news-detail-hero">
        <div class="hero-image-wrapper">
            <img src="{{ $news->img_url }}" alt="{{ $news->title }}" class="hero-image">
            <div class="hero-overlay">
                <div class="hero-gradient"></div>
            </div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-breadcrumb">
                    <a href="{{ route('news.index') }}" class="breadcrumb-link">
                        <span class="breadcrumb-icon">📰</span>
                        <span>Новини</span>
                    </a>
                    <span class="breadcrumb-separator">→</span>
                    <span class="breadcrumb-current">{{ Str::limit($news->title, 50) }}</span>
                </div>
                <h1 class="hero-title">{{ $news->title }}</h1>
                <div class="hero-meta">
                    <div class="meta-item">
                        <span class="meta-icon">📅</span>
                        <span class="meta-text">{{ \Carbon\Carbon::parse($news->date)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-icon">👁️</span>
                        <span class="meta-text">{{ $news->views }} переглядів</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-icon">⏱️</span>
                        <span class="meta-text">{{ rand(3, 8) }} хв читання</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Content -->
    <section class="news-detail-content">
        <div class="container">
            <div class="content-wrapper">
                <!-- Main Content -->
                <div class="main-content">
                    <article class="news-article">
                        <div class="article-content">
                            {!! $news->content !!}
                        </div>

                        <!-- Gallery Section -->
                        @if ($news->gallery && is_array($news->gallery))
                            <div class="news-gallery">
                                <h3 class="gallery-title">
                                    <span class="title-icon">🖼️</span>
                                    Фотогалерея
                                </h3>
                                <div class="gallery-grid">
                                    @foreach ($news->gallery as $index => $item)
                                        <div class="gallery-item" data-index="{{ $index }}">
                                            <div class="gallery-image-wrapper">
                                                <img src="{{ asset('storage/' . $item['image']) }}" 
                                                     alt="Фото {{ $index + 1 }}" 
                                                     class="gallery-image"
                                                     onclick="openLightbox({{ $index }})">
                                                <div class="gallery-overlay">
                                                    <div class="gallery-zoom-icon">🔍</div>
                                                </div>
                                            </div>
                                            @if (!empty($item['caption']))
                                                <p class="gallery-caption">{{ $item['caption'] }}</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Attachments Section -->
                        @if (!empty($news->attachments) && is_array($news->attachments))
                            <div class="news-attachments">
                                <h3 class="attachments-title">
                                    <span class="title-icon">📎</span>
                                    Прикріплені файли
                                </h3>
                                <div class="attachments-list">
                                    @foreach ($news->attachments as $attachment)
                                        <a href="{{ asset('storage/' . $attachment['file']) }}" 
                                           target="_blank" 
                                           class="attachment-item">
                                            <div class="attachment-icon">📄</div>
                                            <div class="attachment-info">
                                                <span class="attachment-name">{{ basename($attachment['file']) }}</span>
                                                <span class="attachment-size">{{ number_format(filesize(storage_path('app/public/' . $attachment['file'])) / 1024, 1) }} KB</span>
                                            </div>
                                            <div class="attachment-download">⬇️</div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Article Footer -->
                        <div class="article-footer">
                            <div class="article-stats">
                                <div class="stat-item">
                                    <span class="stat-icon">👁️</span>
                                    <span class="stat-text">{{ $news->views }} переглядів</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-icon">💬</span>
                                    <span class="stat-text">{{ $comments->total() }} коментарів</span>
                                </div>
                            </div>
                            <div class="article-actions">
                                <button class="action-btn like-btn" onclick="toggleLike()">
                                    <span class="btn-icon">❤️</span>
                                    <span class="btn-text">Подобається</span>
                                </button>
                                <button class="action-btn share-btn" onclick="shareArticle()">
                                    <span class="btn-icon">📤</span>
                                    <span class="btn-text">Поділитися</span>
                                </button>
                                <button class="action-btn bookmark-btn" onclick="toggleBookmark()">
                                    <span class="btn-icon">🔖</span>
                                    <span class="btn-text">Зберегти</span>
                                </button>
                            </div>
                        </div>
                    </article>

                    <!-- Comments Section -->
                    <div class="comments-section">
                        <div class="comments-header">
                            <h3 class="comments-title">
                                <span class="title-icon">💬</span>
                                Коментарі ({{ $comments->total() }})
                            </h3>
                        </div>

                        <!-- Comment Form -->
                        <div class="comment-form-wrapper">
                            <form action="{{ route('news.comment', $news->id) }}" method="POST" class="comment-form">
                                @csrf
                                <div class="form-header">
                                    <h4 class="form-title">Залишити коментар</h4>
                                    <p class="form-subtitle">Поділіться своїми думками про цю новину</p>
                                </div>
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label for="author_name" class="form-label">
                                            <span class="label-icon">👤</span>
                                            Ваше ім'я
                                        </label>
                                        <input type="text" 
                                               id="author_name" 
                                               name="author_name" 
                                               class="form-input" 
                                               placeholder="Введіть ваше ім'я" 
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="content" class="form-label">
                                        <span class="label-icon">💭</span>
                                        Ваш коментар
                                    </label>
                                    <textarea id="content" 
                                              name="content" 
                                              class="form-textarea" 
                                              rows="4" 
                                              placeholder="Напишіть ваш коментар..." 
                                              required></textarea>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="submit-btn">
                                        <span class="btn-icon">📤</span>
                                        <span class="btn-text">Надіслати коментар</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Comments List -->
                        <div class="comments-list">
                            @forelse ($comments as $comment)
                                @include('partials.comment', ['comment' => $comment])
                            @empty
                                <div class="empty-comments">
                                    <div class="empty-icon">💬</div>
                                    <h4 class="empty-title">Поки що немає коментарів</h4>
                                    <p class="empty-description">Станьте першим, хто залишить коментар до цієї новини!</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination -->
                        @if($comments->hasPages())
                            <div class="comments-pagination">
                                {{ $comments->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="sidebar">
                    <div class="sidebar-widget">
                        <h4 class="widget-title">
                            <span class="title-icon">📰</span>
                            Останні новини
                        </h4>
                        <div class="related-news">
                            @php
                                $relatedNews = \App\Models\News::where('id', '!=', $news->id)
                                    ->orderBy('date', 'desc')
                                    ->take(3)
                                    ->get();
                            @endphp
                            @foreach($relatedNews as $related)
                                <a href="{{ route('news.show', $related->id) }}" class="related-item">
                                    <div class="related-image">
                                        <img src="{{ $related->img_url }}" alt="{{ $related->title }}">
                                    </div>
                                    <div class="related-content">
                                        <h5 class="related-title">{{ Str::limit($related->title, 60) }}</h5>
                                        <p class="related-date">{{ \Carbon\Carbon::parse($related->date)->translatedFormat('d M Y') }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="sidebar-widget">
                        <h4 class="widget-title">
                            <span class="title-icon">🏷️</span>
                            Теги
                        </h4>
                        <div class="tags-cloud">
                            <span class="tag">Освіта</span>
                            <span class="tag">Коледж</span>
                            <span class="tag">Студенти</span>
                            <span class="tag">Новини</span>
                            <span class="tag">Події</span>
                            <span class="tag">Навчання</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Lightbox for Gallery -->
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <div class="lightbox-content">
            <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
            <img id="lightbox-image" src="" alt="">
            <div class="lightbox-caption" id="lightbox-caption"></div>
            <div class="lightbox-nav">
                <button class="lightbox-prev" onclick="prevImage()">❮</button>
                <button class="lightbox-next" onclick="nextImage()">❯</button>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
/* News Detail Hero */
.news-detail-hero {
    position: relative;
    min-height: 70vh;
    display: flex;
    align-items: center;
    overflow: hidden;
}

.hero-image-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}

.hero-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.7);
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 2;
}

.hero-gradient {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(
        135deg,
        rgba(0,0,0,0.7) 0%,
        rgba(0,0,0,0.4) 50%,
        rgba(0,0,0,0.7) 100%
    );
}

.hero-content {
    position: relative;
    z-index: 3;
    color: white;
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
}

.hero-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 20px;
    font-size: 14px;
}

.breadcrumb-link {
    display: flex;
    align-items: center;
    gap: 5px;
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumb-link:hover {
    color: white;
}

.breadcrumb-separator {
    color: rgba(255, 255, 255, 0.7);
}

.breadcrumb-current {
    color: white;
    font-weight: 600;
}

.hero-title {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 25px;
    line-height: 1.2;
    text-shadow: 0 4px 20px rgba(0,0,0,0.5);
}

.hero-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 25px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 8px 16px;
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.meta-icon {
    font-size: 16px;
}

.meta-text {
    font-size: 14px;
    font-weight: 500;
}

/* News Detail Content */
.news-detail-content {
    padding: 80px 0;
    background: #f8fafc;
}

.content-wrapper {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 40px;
}

.main-content {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* Article Content */
.news-article {
    padding: 40px;
}

.article-content {
    font-size: 18px;
    line-height: 1.8;
    color: #374151;
    margin-bottom: 40px;
}

.article-content h1,
.article-content h2,
.article-content h3,
.article-content h4 {
    color: #1f2937;
    margin-top: 30px;
    margin-bottom: 20px;
    font-weight: 700;
}

.article-content h1 { font-size: 2.5rem; }
.article-content h2 { font-size: 2rem; }
.article-content h3 { font-size: 1.5rem; }
.article-content h4 { font-size: 1.25rem; }

.article-content p {
    margin-bottom: 20px;
}

.article-content ul,
.article-content ol {
    margin-bottom: 20px;
    padding-left: 30px;
}

.article-content li {
    margin-bottom: 8px;
}

.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    margin: 25px 0;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.article-content blockquote {
    border-left: 4px solid #667eea;
    padding-left: 20px;
    margin: 25px 0;
    font-style: italic;
    color: #6b7280;
    background: #f8fafc;
    padding: 20px;
    border-radius: 8px;
}

.article-content a {
    color: #667eea;
    text-decoration: underline;
    transition: color 0.3s ease;
}

.article-content a:hover {
    color: #5a67d8;
}

/* Gallery Section */
.news-gallery {
    margin: 50px 0;
    padding: 30px;
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
}

.gallery-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 24px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 25px;
}

.title-icon {
    font-size: 28px;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.gallery-item {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.gallery-image-wrapper {
    position: relative;
    height: 200px;
    overflow: hidden;
    cursor: pointer;
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-item:hover .gallery-image {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-zoom-icon {
    font-size: 2rem;
    color: white;
}

.gallery-caption {
    padding: 15px;
    font-size: 14px;
    color: #6b7280;
    text-align: center;
    font-style: italic;
    margin: 0;
}

/* Attachments Section */
.news-attachments {
    margin: 50px 0;
    padding: 30px;
    background: #f0f9ff;
    border-radius: 12px;
    border: 1px solid #bae6fd;
}

.attachments-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 24px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 25px;
}

.attachments-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.attachment-item {
    display: flex;
    align-items: center;
    gap: 15px;
    background: white;
    padding: 15px 20px;
    border-radius: 10px;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    border: 1px solid #e0f2fe;
}

.attachment-item:hover {
    transform: translateX(5px);
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
    color: inherit;
}

.attachment-icon {
    font-size: 24px;
    color: #3b82f6;
}

.attachment-info {
    flex: 1;
}

.attachment-name {
    display: block;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 4px;
}

.attachment-size {
    font-size: 12px;
    color: #6b7280;
}

.attachment-download {
    font-size: 20px;
    color: #10b981;
}

/* Article Footer */
.article-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 30px 0;
    border-top: 1px solid #e5e7eb;
    margin-top: 40px;
}

.article-stats {
    display: flex;
    gap: 20px;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6b7280;
    font-size: 14px;
}

.stat-icon {
    font-size: 16px;
}

.article-actions {
    display: flex;
    gap: 12px;
}

.action-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #f3f4f6;
    border: none;
    padding: 10px 16px;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 14px;
    font-weight: 500;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.like-btn:hover {
    background: #fef2f2;
    color: #dc2626;
}

.share-btn:hover {
    background: #eff6ff;
    color: #2563eb;
}

.bookmark-btn:hover {
    background: #fefce8;
    color: #ca8a04;
}

.btn-icon {
    font-size: 16px;
}

/* Comments Section */
.comments-section {
    background: #f8fafc;
    padding: 40px;
    margin-top: 40px;
    border-radius: 16px;
}

.comments-header {
    margin-bottom: 30px;
}

.comments-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 28px;
    font-weight: 700;
    color: #1f2937;
    margin: 0;
}

/* Comment Form */
.comment-form-wrapper {
    background: white;
    border-radius: 16px;
    padding: 30px;
    margin-bottom: 40px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.form-header {
    margin-bottom: 25px;
    text-align: center;
}

.form-title {
    font-size: 20px;
    font-weight: 700;
    color: #1f2937;
    margin: 0 0 8px 0;
}

.form-subtitle {
    color: #6b7280;
    margin: 0;
    font-size: 14px;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
    margin-bottom: 25px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
}

.label-icon {
    font-size: 16px;
}

.form-input,
.form-textarea {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    font-size: 14px;
    transition: all 0.3s ease;
    background: #f9fafb;
}

.form-input:focus,
.form-textarea:focus {
    outline: none;
    border-color: #667eea;
    background: white;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-textarea {
    resize: vertical;
    min-height: 100px;
    font-family: inherit;
}

.form-actions {
    display: flex;
    justify-content: center;
}

.submit-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
}

/* Comments List */
.comments-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* Comment Item */
.comment-item {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.comment-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.comment-reply {
    margin-left: 40px;
    margin-top: 15px;
}

.comment-card {
    padding: 25px;
}

.comment-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 15px;
}

.comment-author {
    display: flex;
    align-items: center;
    gap: 15px;
}

.author-avatar {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 16px;
}

.author-info {
    flex: 1;
}

.author-name {
    font-size: 16px;
    font-weight: 600;
    color: #1f2937;
    margin: 0 0 4px 0;
}

.comment-date {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #6b7280;
    margin: 0;
}

.date-icon {
    font-size: 14px;
}

.date-full {
    margin-left: 8px;
    opacity: 0.7;
}

.comment-actions {
    display: flex;
    gap: 8px;
}

.comment-action-btn {
    display: flex;
    align-items: center;
    gap: 4px;
    background: #f3f4f6;
    border: none;
    padding: 6px 12px;
    border-radius: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 12px;
}

.comment-action-btn:hover {
    background: #e5e7eb;
    transform: scale(1.05);
}

.like-btn:hover {
    background: #fef2f2;
    color: #dc2626;
}

.reply-btn:hover {
    background: #eff6ff;
    color: #2563eb;
}

.action-icon {
    font-size: 14px;
}

.action-count {
    font-weight: 600;
}

.comment-content {
    margin-bottom: 15px;
}

.comment-text {
    color: #374151;
    line-height: 1.6;
    margin: 0;
    font-size: 15px;
}

/* Reply Form */
.reply-form-wrapper {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #e5e7eb;
}

.reply-form {
    background: #f8fafc;
    padding: 20px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
}

.reply-form-header {
    margin-bottom: 15px;
}

.reply-form-title {
    font-size: 14px;
    font-weight: 600;
    color: #374151;
    margin: 0;
}

.reply-form .form-group {
    margin-bottom: 15px;
}

.reply-form .form-input,
.reply-form .form-textarea {
    font-size: 13px;
    padding: 10px 12px;
}

.reply-form .form-actions {
    display: flex;
    gap: 10px;
    justify-content: flex-start;
}

.reply-form .submit-btn {
    padding: 8px 16px;
    font-size: 14px;
}

.cancel-btn {
    background: #f3f4f6;
    color: #6b7280;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.3s ease;
}

.cancel-btn:hover {
    background: #e5e7eb;
}

/* Comment Replies */
.comment-replies {
    margin-top: 20px;
    padding-left: 20px;
    border-left: 3px solid #e5e7eb;
}

/* Empty Comments */
.empty-comments {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.empty-icon {
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.7;
}

.empty-title {
    font-size: 24px;
    font-weight: 700;
    color: #374151;
    margin: 0 0 15px 0;
}

.empty-description {
    color: #6b7280;
    margin: 0;
    font-size: 16px;
    line-height: 1.6;
}

/* Sidebar */
.sidebar {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.sidebar-widget {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.widget-title {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 18px;
    font-weight: 700;
    color: #1f2937;
    margin: 0 0 20px 0;
}

/* Related News */
.related-news {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.related-item {
    display: flex;
    gap: 12px;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    padding: 12px;
    border-radius: 10px;
}

.related-item:hover {
    background: #f8fafc;
    transform: translateX(5px);
    color: inherit;
}

.related-image {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
}

.related-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.related-content {
    flex: 1;
}

.related-title {
    font-size: 14px;
    font-weight: 600;
    color: #1f2937;
    margin: 0 0 5px 0;
    line-height: 1.4;
}

.related-date {
    font-size: 12px;
    color: #6b7280;
    margin: 0;
}

/* Tags Cloud */
.tags-cloud {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.tag {
    background: #f3f4f6;
    color: #374151;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
}

.tag:hover {
    background: #667eea;
    color: white;
    transform: translateY(-1px);
}

/* Lightbox */
.lightbox {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.9);
    animation: fadeIn 0.3s ease;
}

.lightbox-content {
    position: relative;
    margin: auto;
    padding: 20px;
    width: 90%;
    max-width: 800px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.lightbox-close {
    position: absolute;
    top: 20px;
    right: 35px;
    color: white;
    font-size: 40px;
    font-weight: bold;
    cursor: pointer;
    z-index: 1001;
}

.lightbox-close:hover {
    opacity: 0.7;
}

#lightbox-image {
    max-width: 100%;
    max-height: 80%;
    object-fit: contain;
    border-radius: 8px;
}

.lightbox-caption {
    color: white;
    text-align: center;
    margin-top: 20px;
    font-size: 16px;
}

.lightbox-nav {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 0 20px;
    transform: translateY(-50%);
}

.lightbox-prev,
.lightbox-next {
    background: rgba(255,255,255,0.2);
    color: white;
    border: none;
    padding: 15px 20px;
    font-size: 18px;
    cursor: pointer;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.lightbox-prev:hover,
.lightbox-next:hover {
    background: rgba(255,255,255,0.4);
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-meta {
        flex-direction: column;
        gap: 15px;
    }
    
    .content-wrapper {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .news-article {
        padding: 25px;
    }
    
    .article-content {
        font-size: 16px;
    }
    
    .gallery-grid {
        grid-template-columns: 1fr;
    }
    
    .comment-reply {
        margin-left: 20px;
    }
    
    .comment-replies {
        padding-left: 15px;
    }
    
    .article-footer {
        flex-direction: column;
        gap: 20px;
        align-items: flex-start;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 1.5rem;
    }
    
    .news-article {
        padding: 20px;
    }
    
    .comment-form-wrapper {
        padding: 20px;
    }
    
    .comment-card {
        padding: 20px;
    }
    
    .comment-reply {
        margin-left: 10px;
    }
    
    .author-avatar {
        width: 35px;
        height: 35px;
        font-size: 14px;
    }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
</style>
@endsection

@section('scripts')
<script>
// Gallery lightbox functionality
let currentImageIndex = 0;
let galleryImages = [];

document.addEventListener('DOMContentLoaded', function() {
    // Initialize gallery
    const galleryItems = document.querySelectorAll('.gallery-item');
    galleryImages = Array.from(galleryItems).map(item => {
        const img = item.querySelector('.gallery-image');
        const caption = item.querySelector('.gallery-caption');
        return {
            src: img.src,
            alt: img.alt,
            caption: caption ? caption.textContent : ''
        };
    });

    // Article actions
    initializeArticleActions();
    
    // Comment actions
    initializeCommentActions();
});

function openLightbox(index) {
    currentImageIndex = index;
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxCaption = document.getElementById('lightbox-caption');
    
    lightboxImage.src = galleryImages[index].src;
    lightboxImage.alt = galleryImages[index].alt;
    lightboxCaption.textContent = galleryImages[index].caption;
    
    lightbox.style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.style.display = 'none';
    document.body.style.overflow = 'auto';
}

function prevImage() {
    currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
    openLightbox(currentImageIndex);
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
    openLightbox(currentImageIndex);
}

// Article actions
function initializeArticleActions() {
    // Like functionality
    window.toggleLike = function() {
        const likeBtn = document.querySelector('.like-btn');
        const icon = likeBtn.querySelector('.btn-icon');
        const text = likeBtn.querySelector('.btn-text');
        
        if (likeBtn.classList.contains('liked')) {
            likeBtn.classList.remove('liked');
            icon.textContent = '🤍';
            text.textContent = 'Подобається';
            likeBtn.style.background = '#f3f4f6';
            likeBtn.style.color = '#6b7280';
        } else {
            likeBtn.classList.add('liked');
            icon.textContent = '❤️';
            text.textContent = 'Подобається';
            likeBtn.style.background = '#fef2f2';
            likeBtn.style.color = '#dc2626';
        }
    };

    // Share functionality
    window.shareArticle = function() {
        const title = document.querySelector('.hero-title').textContent;
        const url = window.location.href;
        
        if (navigator.share) {
            navigator.share({
                title: title,
                url: url
            });
        } else {
            navigator.clipboard.writeText(url).then(() => {
                showNotification('Посилання скопійовано!', 'success');
            });
        }
    };

    // Bookmark functionality
    window.toggleBookmark = function() {
        const bookmarkBtn = document.querySelector('.bookmark-btn');
        const icon = bookmarkBtn.querySelector('.btn-icon');
        const text = bookmarkBtn.querySelector('.btn-text');
        
        if (bookmarkBtn.classList.contains('bookmarked')) {
            bookmarkBtn.classList.remove('bookmarked');
            icon.textContent = '🔖';
            text.textContent = 'Зберегти';
            bookmarkBtn.style.background = '#f3f4f6';
            bookmarkBtn.style.color = '#6b7280';
        } else {
            bookmarkBtn.classList.add('bookmarked');
            icon.textContent = '🔖';
            text.textContent = 'Збережено';
            bookmarkBtn.style.background = '#fefce8';
            bookmarkBtn.style.color = '#ca8a04';
        }
    };
}

// Comment actions
function initializeCommentActions() {
    // Toggle reply form
    window.toggleReplyForm = function(commentId) {
        const replyForm = document.getElementById(`reply-form-${commentId}`);
        if (replyForm.style.display === 'none' || replyForm.style.display === '') {
            replyForm.style.display = 'block';
            replyForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else {
            replyForm.style.display = 'none';
        }
    };

    // Toggle comment like
    window.toggleCommentLike = function(commentId) {
        const likeBtn = document.querySelector(`[data-comment-id="${commentId}"] .like-btn`);
        const icon = likeBtn.querySelector('.action-icon');
        const count = likeBtn.querySelector('.action-count');
        
        if (likeBtn.classList.contains('liked')) {
            likeBtn.classList.remove('liked');
            icon.textContent = '👍';
            count.textContent = parseInt(count.textContent) - 1;
            likeBtn.style.background = '#f3f4f6';
            likeBtn.style.color = '#6b7280';
        } else {
            likeBtn.classList.add('liked');
            icon.textContent = '👍';
            count.textContent = parseInt(count.textContent) + 1;
            likeBtn.style.background = '#fef2f2';
            likeBtn.style.color = '#dc2626';
        }
    };
}

// Form enhancements
document.addEventListener('DOMContentLoaded', function() {
    // Comment form validation
    const commentForm = document.querySelector('.comment-form');
    if (commentForm) {
        commentForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.submit-btn');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnIcon = submitBtn.querySelector('.btn-icon');
            
            // Disable button and show loading state
            submitBtn.disabled = true;
            btnText.textContent = 'Відправляємо...';
            btnIcon.textContent = '⏳';
            
            // Re-enable after 3 seconds if form doesn't submit
            setTimeout(() => {
                submitBtn.disabled = false;
                btnText.textContent = 'Надіслати коментар';
                btnIcon.textContent = '📤';
            }, 3000);
        });
    }

    // Reply forms validation
    const replyForms = document.querySelectorAll('.reply-form');
    replyForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.submit-btn');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnIcon = submitBtn.querySelector('.btn-icon');
            
            submitBtn.disabled = true;
            btnText.textContent = 'Відправляємо...';
            btnIcon.textContent = '⏳';
            
            setTimeout(() => {
                submitBtn.disabled = false;
                btnText.textContent = 'Відповісти';
                btnIcon.textContent = '📤';
            }, 3000);
        });
    });

    // Auto-resize textareas
    const textareas = document.querySelectorAll('.form-textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });
});

// Keyboard navigation for lightbox
document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('lightbox');
    if (lightbox && lightbox.style.display === 'block') {
        switch(e.key) {
            case 'Escape':
                closeLightbox();
                break;
            case 'ArrowLeft':
                prevImage();
                break;
            case 'ArrowRight':
                nextImage();
                break;
        }
    }
});

// Smooth scrolling for internal links
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

// Notification function
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <span class="notification-icon">${type === 'success' ? '✅' : 'ℹ️'}</span>
            <span class="notification-message">${message}</span>
        </div>
    `;
    
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#10b981' : '#3b82f6'};
        color: white;
        padding: 15px 20px;
        border-radius: 10px;
        z-index: 1000;
        animation: slideInRight 0.3s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        max-width: 300px;
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease forwards';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Add CSS for animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    .notification-content {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .notification-icon {
        font-size: 18px;
    }
    
    .notification-message {
        font-weight: 500;
    }
`;
document.head.appendChild(style);
</script>
@endsection
