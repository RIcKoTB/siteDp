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

@push('styles')
<style>
/* Hero Section */
.graduates-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 4rem 0;
    margin-bottom: 3rem;
}

.hero-content {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.graduates-hero h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.graduates-hero p {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 2rem;
}

.hero-stats {
    display: flex;
    justify-content: center;
    gap: 3rem;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 2.5rem;
    font-weight: 700;
    color: #fff;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

/* Featured Graduates */
.featured-graduates {
    padding: 3rem 0;
    background: #f8f9fa;
}

.section-header {
    text-align: center;
    margin-bottom: 3rem;
}

.section-header h2 {
    font-size: 2rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.section-header p {
    color: #6c757d;
    font-size: 1.1rem;
}

.featured-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
}

.featured-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    position: relative;
}

.featured-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

.graduate-photo {
    position: relative;
    width: 100px;
    height: 100px;
    margin: 0 auto 1.5rem;
}

.graduate-photo img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #667eea;
}

.photo-placeholder {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 4px solid #667eea;
}

.placeholder-icon {
    font-size: 2.5rem;
    color: white;
}

.featured-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #ffc107;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.graduate-info {
    text-align: center;
}

.graduate-info h3 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.specialty {
    color: #667eea;
    font-weight: 500;
    margin-bottom: 0.25rem;
}

.graduation-year {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.current-work {
    background: #e3f2fd;
    padding: 0.75rem;
    border-radius: 8px;
    margin-bottom: 1rem;
}

.current-work strong {
    display: block;
    color: #1976d2;
    margin-bottom: 0.25rem;
}

.current-work span {
    color: #424242;
    font-size: 0.9rem;
}

.testimonial {
    font-style: italic;
    color: #6c757d;
    margin: 1rem 0;
    padding: 1rem;
    background: #f8f9fa;
    border-left: 4px solid #667eea;
    border-radius: 0 8px 8px 0;
}

/* Filters */
.graduates-filters {
    padding: 2rem 0;
    background: white;
    border-bottom: 1px solid #e9ecef;
}

.filters-form {
    max-width: 1000px;
    margin: 0 auto;
}

.filters-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr auto auto;
    gap: 1rem;
    align-items: end;
}

.search-box {
    position: relative;
}

.search-input {
    width: 100%;
    padding: 0.75rem 3rem 0.75rem 1rem;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.search-input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.search-btn {
    position: absolute;
    right: 0.5rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    font-size: 1.2rem;
    cursor: pointer;
    padding: 0.5rem;
}

.filter-select {
    padding: 0.75rem;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 1rem;
    background: white;
    transition: border-color 0.3s ease;
}

.filter-select:focus {
    outline: none;
    border-color: #667eea;
}

/* Graduates Grid */
.graduates-grid-section {
    padding: 3rem 0;
}

.graduates-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.graduate-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.graduate-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.card-header {
    position: relative;
    padding: 1.5rem;
    text-align: center;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
}

.card-header .graduate-photo {
    width: 80px;
    height: 80px;
    margin: 0 auto;
}

.card-header .graduate-photo img {
    border: 3px solid #667eea;
}

.card-header .photo-placeholder {
    border: 3px solid #667eea;
}

.card-header .featured-badge {
    top: 10px;
    right: 10px;
}

.card-body {
    padding: 1.5rem;
    text-align: center;
}

.graduate-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.card-body .specialty {
    color: #667eea;
    font-weight: 500;
    margin-bottom: 0.25rem;
}

.card-body .graduation-year {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.card-body .current-work {
    background: #f8f9fa;
    padding: 0.75rem;
    border-radius: 6px;
    margin-bottom: 1rem;
}

.position {
    font-weight: 500;
    color: #2c3e50;
    margin-bottom: 0.25rem;
}

.company {
    color: #6c757d;
    font-size: 0.9rem;
}

.experience {
    margin-bottom: 1rem;
}

.experience-badge {
    background: #e3f2fd;
    color: #1976d2;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.card-footer {
    padding: 1rem 1.5rem;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
    display: flex;
    gap: 0.5rem;
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
    font-size: 0.9rem;
}

.btn-primary {
    background: #667eea;
    color: white;
}

.btn-primary:hover {
    background: #5a6fd8;
    transform: translateY(-1px);
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
}

.btn-outline {
    background: transparent;
    color: #667eea;
    border: 2px solid #667eea;
    flex: 1;
}

.btn-outline:hover {
    background: #667eea;
    color: white;
}

.btn-linkedin {
    background: #0077b5;
    color: white;
}

.btn-linkedin:hover {
    background: #005885;
}

/* No Results */
.no-results {
    text-align: center;
    padding: 4rem 2rem;
}

.no-results-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.no-results h3 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.no-results p {
    color: #6c757d;
    margin-bottom: 2rem;
}

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

/* Responsive */
@media (max-width: 768px) {
    .graduates-hero h1 {
        font-size: 2rem;
    }
    
    .hero-stats {
        gap: 2rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .filters-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .featured-grid {
        grid-template-columns: 1fr;
    }
    
    .graduates-grid {
        grid-template-columns: 1fr;
    }
    
    .card-footer {
        flex-direction: column;
    }
}
</style>
@endpush
