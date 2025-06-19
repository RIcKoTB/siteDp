@extends('layouts.app')

@section('title', $graduate->full_name . ' - Випускники')

@section('content')

<!-- Graduate Hero -->
<section class="graduate-hero" style="background-image: url('/storage/images/1.jpg')">
    <div class="container">
        <div class="hero-content">
            <div class="graduate-main-info">
                <div class="graduate-photo-large">
                    @if($graduate->photo)
                        <img src="{{ $graduate->photo }}" alt="{{ $graduate->full_name }}">
                    @else
                        <div class="photo-placeholder-large">
                            <span class="placeholder-icon">👤</span>
                        </div>
                    @endif
                    @if($graduate->is_featured)
                        <div class="featured-badge-large">⭐</div>
                    @endif
                </div>

                <div class="graduate-details">
                    <h1>{{ $graduate->full_name }}</h1>
                    <p class="specialty">{{ $graduate->specialty }}</p>
                    <p class="graduation-info">{{ $graduate->graduation_status }}</p>

                    @if($graduate->current_position || $graduate->company)
                        <div class="current-position">
                            @if($graduate->current_position)
                                <h3>{{ $graduate->current_position }}</h3>
                            @endif
                            @if($graduate->company)
                                <p>{{ $graduate->company }}</p>
                            @endif
                        </div>
                    @endif

                    <div class="contact-links">
                        @if($graduate->contact_email)
                            <a href="mailto:{{ $graduate->contact_email }}" class="contact-btn">
                                📧 Email
                            </a>
                        @endif

                        @if($graduate->linkedin_url)
                            <a href="{{ $graduate->linkedin_url }}" target="_blank" class="contact-btn linkedin">
                                💼 LinkedIn
                            </a>
                        @endif

                        @if($graduate->contact_phone)
                            <a href="tel:{{ $graduate->contact_phone }}" class="contact-btn">
                                📞 Телефон
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Graduate Content -->
<section class="graduate-content">
    <div class="container">
        <div class="content-grid">
            <div class="main-content">
                @if($graduate->testimonial)
                    <div class="testimonial-section">
                        <h2>💬 Відгук про навчання</h2>
                        <blockquote class="testimonial-text">
                            "{{ $graduate->testimonial }}"
                        </blockquote>
                    </div>
                @endif

                @if($graduate->achievements)
                    <div class="achievements-section">
                        <h2>🏆 Досягнення</h2>
                        <div class="achievements-text">
                            {!! nl2br(e($graduate->achievements)) !!}
                        </div>
                    </div>
                @endif

                <div class="experience-section">
                    <h2>📈 Професійний досвід</h2>
                    <div class="experience-info">
                        <div class="experience-item">
                            <span class="experience-label">Років досвіду:</span>
                            <span class="experience-value">{{ $graduate->experience_years }} {{ $graduate->experience_years == 1 ? 'рік' : ($graduate->experience_years < 5 ? 'роки' : 'років') }}</span>
                        </div>

                        @if($graduate->current_position)
                            <div class="experience-item">
                                <span class="experience-label">Поточна посада:</span>
                                <span class="experience-value">{{ $graduate->current_position }}</span>
                            </div>
                        @endif

                        @if($graduate->company)
                            <div class="experience-item">
                                <span class="experience-label">Компанія:</span>
                                <span class="experience-value">{{ $graduate->company }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="sidebar">
                <div class="graduate-stats">
                    <h3>📊 Інформація</h3>
                    <div class="stat-item">
                        <span class="stat-label">Спеціальність:</span>
                        <span class="stat-value">{{ $graduate->specialty }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Рік випуску:</span>
                        <span class="stat-value">{{ $graduate->graduation_year }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Досвід роботи:</span>
                        <span class="stat-value">{{ $graduate->experience_years }} {{ $graduate->experience_years == 1 ? 'рік' : ($graduate->experience_years < 5 ? 'роки' : 'років') }}</span>
                    </div>
                    @if($graduate->is_featured)
                        <div class="stat-item">
                            <span class="stat-label">Статус:</span>
                            <span class="stat-value featured">⭐ Рекомендований</span>
                        </div>
                    @endif
                </div>

                <div class="back-to-list">
                    <a href="{{ route('graduates.index') }}" class="btn btn-outline">
                        ← Повернутися до списку
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Graduates -->
@if($relatedGraduates->count() > 0)
<section class="related-graduates">
    <div class="container">
        <h2>👥 Схожі випускники</h2>
        <div class="related-grid">
            @foreach($relatedGraduates as $related)
                <div class="related-card">
                    <div class="related-photo">
                        @if($related->photo)
                            <img src="{{ $related->photo }}" alt="{{ $related->full_name }}">
                        @else
                            <div class="photo-placeholder-small">
                                <span class="placeholder-icon">👤</span>
                            </div>
                        @endif
                        @if($related->is_featured)
                            <div class="featured-badge-small">⭐</div>
                        @endif
                    </div>

                    <div class="related-info">
                        <h4>{{ $related->full_name }}</h4>
                        <p class="related-specialty">{{ $related->specialty }}</p>
                        <p class="related-year">{{ $related->graduation_year }} рік</p>

                        @if($related->current_position)
                            <p class="related-position">{{ $related->current_position }}</p>
                        @endif

                        <a href="{{ route('graduates.show', $related->id) }}" class="btn btn-sm">
                            Детальніше
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('styles')
<style>
/* Graduate Hero */
.graduate-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 4rem 0;
    margin-bottom: 3rem;
    position: relative;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.graduate-hero::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1;
}

.graduate-hero .container {
    position: relative;
    z-index: 2;
}

.hero-content {
    max-width: 1000px;
    margin: 0 auto;
}

.graduate-main-info {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 3rem;
    align-items: center;
}

.graduate-photo-large {
    position: relative;
    width: 200px;
    height: 200px;
}

.graduate-photo-large img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 6px solid rgba(255, 255, 255, 0.3);
}

.photo-placeholder-large {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 6px solid rgba(255, 255, 255, 0.3);
}

.photo-placeholder-large .placeholder-icon {
    font-size: 4rem;
    color: rgba(255, 255, 255, 0.7);
}

.featured-badge-large {
    position: absolute;
    top: -10px;
    right: -10px;
    background: #ffc107;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.graduate-details h1 {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 1rem;
    letter-spacing: -0.02em;
    line-height: 1.1;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: none;
    position: relative;
}

.graduate-details h1::after {
    content: "";
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, #ffc107 0%, #ff9800 100%);
    border-radius: 2px;
}

.graduate-details .specialty {
    font-size: 1.4rem;
    color: #ffc107;
    font-weight: 600;
    margin-bottom: 0.5rem;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}

.graduation-info {
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 2rem;
    font-weight: 400;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}

.graduation-info {
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 2rem;
}

.current-position {
    margin-bottom: 2.5rem;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.current-position h3 {
    font-size: 1.6rem;
    margin-bottom: 0.5rem;
    color: #ffc107;
    font-weight: 700;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}

.current-position p {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 500;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}

.current-position h3 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

.current-position p {
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.9);
}

.contact-links {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.contact-btn {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.contact-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

.contact-btn.linkedin {
    background: #0077b5;
}

.contact-btn.linkedin:hover {
    background: #005885;
}

/* Graduate Content */
.graduate-content {
    padding: 3rem 0;
}

.content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 3rem;
}

.main-content > div {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

.main-content h2 {
    color: #2c3e50;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.testimonial-text {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #495057;
    font-style: italic;
    padding: 1.5rem;
    background: #f8f9fa;
    border-left: 4px solid #667eea;
    border-radius: 0 8px 8px 0;
    margin: 0;
}

.achievements-text {
    font-size: 1rem;
    line-height: 1.7;
    color: #495057;
}

.experience-info {
    display: grid;
    gap: 1rem;
}

.experience-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.experience-label {
    font-weight: 600;
    color: #6c757d;
}

.experience-value {
    color: #2c3e50;
    font-weight: 500;
}

/* Sidebar */
.sidebar > div {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

.graduate-stats h3 {
    color: #2c3e50;
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #e9ecef;
}

.stat-item:last-child {
    border-bottom: none;
}

.stat-label {
    font-weight: 500;
    color: #6c757d;
}

.stat-value {
    color: #2c3e50;
    font-weight: 600;
}

.stat-value.featured {
    color: #ffc107;
}

/* Related Graduates */
.related-graduates {
    padding: 3rem 0;
    background: #f8f9fa;
}

.related-graduates h2 {
    text-align: center;
    color: #2c3e50;
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 3rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.related-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.related-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.related-photo {
    position: relative;
    width: 80px;
    height: 80px;
    margin: 0 auto 1rem;
}

.related-photo img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #667eea;
}

.photo-placeholder-small {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid #667eea;
}

.photo-placeholder-small .placeholder-icon {
    font-size: 2rem;
    color: white;
}

.featured-badge-small {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #ffc107;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.related-info h4 {
    color: #2c3e50;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.related-specialty {
    color: #667eea;
    font-weight: 500;
    margin-bottom: 0.25rem;
}

.related-year {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.related-position {
    color: #495057;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

/* Buttons */
.btn {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    text-align: center;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-outline {
    background: transparent;
    color: #667eea;
    border: 2px solid #667eea;
    width: 100%;
}

.btn-outline:hover {
    background: #667eea;
    color: white;
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
    background: #667eea;
    color: white;
}

.btn-sm:hover {
    background: #5a6fd8;
    transform: translateY(-1px);
}

/* Responsive */
@media (max-width: 768px) {
    .graduate-main-info {
        grid-template-columns: 1fr;
        text-align: center;
        gap: 2rem;
    }

    .graduate-photo-large {
        width: 150px;
        height: 150px;
        margin: 0 auto;
    }

.graduate-details h1 {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 1rem;
    letter-spacing: -0.02em;
    line-height: 1.1;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: none;
    position: relative;
}

.graduate-details h1::after {
    content: "";
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, #ffc107 0%, #ff9800 100%);
    border-radius: 2px;
}

    .content-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .contact-links {
        justify-content: center;
    }

    .related-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

