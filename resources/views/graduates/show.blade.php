@extends('layouts.app')

@section('title', $graduate->full_name . ' - Випускники')

@section('content')

<!-- Graduate Hero -->
<section class="graduate-hero">
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
