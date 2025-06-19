@extends('layouts.app')

@section('title', 'Випускники')

@section('content')

<!-- Hero Section -->
<section class="graduates-hero">
    <div class="container">
        <div class="hero-content">
            <h1>🎓 Наші випускники</h1>
            <p>Пишаємося досягненнями наших випускників та їхніми успіхами в професійній діяльності</p>
            
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $graduates->total() }}</span>
                    <span class="stat-label">Випускників</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ count($availableSpecialties) }}</span>
                    <span class="stat-label">Спеціальностей</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ count($availableYears) }}</span>
                    <span class="stat-label">Років випуску</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Graduates -->
@if($featuredGraduates->count() > 0)
<section class="featured-graduates">
    <div class="container">
        <div class="section-header">
            <h2>⭐ Рекомендовані випускники</h2>
            <p>Випускники, які досягли особливих успіхів у своїй професійній діяльності</p>
        </div>
        
        <div class="featured-grid">
            @foreach($featuredGraduates as $graduate)
                <div class="featured-card">
                    <div class="graduate-photo">
                        @if($graduate->photo)
                            <img src="{{ $graduate->photo }}" alt="{{ $graduate->full_name }}">
                        @else
                            <div class="photo-placeholder">
                                <span class="placeholder-icon">👤</span>
                            </div>
                        @endif
                        <div class="featured-badge">⭐</div>
                    </div>
                    
                    <div class="graduate-info">
                        <h3>{{ $graduate->full_name }}</h3>
                        <p class="specialty">{{ $graduate->specialty }}</p>
                        <p class="graduation-year">{{ $graduate->graduation_status }}</p>
                        
                        @if($graduate->current_position && $graduate->company)
                            <div class="current-work">
                                <strong>{{ $graduate->current_position }}</strong>
                                <span>в {{ $graduate->company }}</span>
                            </div>
                        @endif
                        
                        @if($graduate->testimonial)
                            <blockquote class="testimonial">
                                "{{ Str::limit($graduate->testimonial, 120) }}"
                            </blockquote>
                        @endif
                        
                        <a href="{{ route('graduates.show', $graduate->id) }}" class="btn btn-primary">
                            Детальніше
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Search and Filters -->
<section class="graduates-filters">
    <div class="container">
        <form method="GET" class="filters-form">
            <div class="filters-grid">
                <div class="search-box">
                    <input type="text" 
                           name="search" 
                           placeholder="Пошук за ім'ям, компанією, посадою..." 
                           value="{{ request('search') }}"
                           class="search-input">
                    <button type="submit" class="search-btn">🔍</button>
                </div>
                
                <select name="year" class="filter-select">
                    <option value="">Всі роки випуску</option>
                    @foreach($availableYears as $year)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                            {{ $year }} рік
                        </option>
                    @endforeach
                </select>
                
                <select name="specialty" class="filter-select">
                    <option value="">Всі спеціальності</option>
                    @foreach($availableSpecialties as $specialty)
                        <option value="{{ $specialty }}" {{ request('specialty') == $specialty ? 'selected' : '' }}>
                            {{ $specialty }}
                        </option>
                    @endforeach
                </select>
                
                <button type="submit" class="btn btn-primary">Фільтрувати</button>
                
                @if(request()->hasAny(['search', 'year', 'specialty']))
                    <a href="{{ route('graduates.index') }}" class="btn btn-secondary">Очистити</a>
                @endif
            </div>
        </form>
    </div>
</section>

<!-- Graduates Grid -->
<section class="graduates-grid-section">
    <div class="container">
        @if($graduates->count() > 0)
            <div class="graduates-grid">
                @foreach($graduates as $graduate)
                    <div class="graduate-card">
                        <div class="card-header">
                            <div class="graduate-photo">
                                @if($graduate->photo)
                                    <img src="{{ $graduate->photo }}" alt="{{ $graduate->full_name }}">
                                @else
                                    <div class="photo-placeholder">
                                        <span class="placeholder-icon">👤</span>
                                    </div>
                                @endif
                            </div>
                            
                            @if($graduate->is_featured)
                                <div class="featured-badge">⭐</div>
                            @endif
                        </div>
                        
                        <div class="card-body">
                            <h3 class="graduate-name">{{ $graduate->full_name }}</h3>
                            <p class="specialty">{{ $graduate->specialty }}</p>
                            <p class="graduation-year">{{ $graduate->graduation_status }}</p>
                            
                            @if($graduate->current_position || $graduate->company)
                                <div class="current-work">
                                    @if($graduate->current_position)
                                        <div class="position">{{ $graduate->current_position }}</div>
                                    @endif
                                    @if($graduate->company)
                                        <div class="company">{{ $graduate->company }}</div>
                                    @endif
                                </div>
                            @endif
                            
                            @if($graduate->experience_years > 0)
                                <div class="experience">
                                    <span class="experience-badge">
                                        {{ $graduate->experience_years }} {{ $graduate->experience_years == 1 ? 'рік' : ($graduate->experience_years < 5 ? 'роки' : 'років') }} досвіду
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="card-footer">
                            <a href="{{ route('graduates.show', $graduate->id) }}" class="btn btn-outline">
                                Детальніше
                            </a>
                            
                            @if($graduate->linkedin_url)
                                <a href="{{ $graduate->linkedin_url }}" target="_blank" class="btn btn-linkedin">
                                    LinkedIn
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $graduates->appends(request()->query())->links() }}
            </div>
        @else
            <div class="no-results">
                <div class="no-results-icon">🎓</div>
                <h3>Випускників не знайдено</h3>
                <p>Спробуйте змінити параметри пошуку або фільтрації</p>
                <a href="{{ route('graduates.index') }}" class="btn btn-primary">Показати всіх</a>
            </div>
        @endif
    </div>
</section>

@endsection
