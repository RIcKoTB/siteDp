@extends('layouts.app')

@section('title', 'Освітньо-професійні програми')

@section('content')

<!-- Hero Section -->
<section class="hero">
    <div class="hero-overlay">
        <div class="container">
            <h1>🎓 Освітньо-професійні програми</h1>
            <p>Сучасні програми підготовки кваліфікованих фахівців</p>
        </div>
    </div>
</section>

<!-- Programs Section -->
<section class="programs-section">
    <div class="container">
        @if($programs->count() > 0)
            <div class="section-header">
                <h2>Наші освітньо-професійні програми</h2>
                <p>Оберіть програму, яка відповідає вашим інтересам та кар'єрним цілям</p>
            </div>

            <div class="programs-grid">
                @foreach($programs as $program)
                    <div class="program-card">
                        <div class="card-header">
                            @if($program->image)
                                <div class="program-image">
                                    <img src="{{ $program->image }}" alt="{{ $program->title }}">
                                </div>
                            @endif
                            <div class="program-badge">
                                {{ $program->code }}
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <h3 class="program-title">
                                <a href="{{ route('programs.show', $program->id) }}">
                                    {{ $program->title }}
                                </a>
                            </h3>
                            
                            @if($program->qualification)
                                <div class="qualification">
                                    🎯 {{ $program->qualification }}
                                </div>
                            @endif
                            
                            <p class="program-description">
                                {{ Str::limit($program->description, 150) }}
                            </p>
                            
                            <div class="program-details">
                                <div class="detail-item">
                                    <span class="icon">⏰</span>
                                    <span>{{ $program->duration_years }} {{ $program->duration_years == 1 ? 'рік' : ($program->duration_years < 5 ? 'роки' : 'років') }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="icon">📚</span>
                                    <span>{{ $program->credits_total }} кредитів</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <a href="{{ route('programs.show', $program->id) }}" class="btn btn-primary">
                                Детальніше про програму
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-results">
                <div class="no-results-icon">🎓</div>
                <h3>Програми не знайдено</h3>
                <p>Наразі немає доступних освітньо-професійних програм</p>
            </div>
        @endif
    </div>
</section>

@endsection

@push('styles')
<style>
/* Hero Section */
.hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-align: center;
    padding: 4rem 0;
    margin-bottom: 3rem;
}

.hero h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.hero p {
    font-size: 1.2rem;
    opacity: 0.9;
}

/* Programs Section */
.programs-section {
    padding: 2rem 0 4rem;
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

/* Programs Grid */
.programs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.program-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.program-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.card-header {
    position: relative;
    height: 200px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.program-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.program-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: #667eea;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.card-body {
    padding: 1.5rem;
}

.program-title {
    margin: 0 0 1rem 0;
    font-size: 1.3rem;
    font-weight: 600;
}

.program-title a {
    color: #2c3e50;
    text-decoration: none;
    transition: color 0.3s ease;
}

.program-title a:hover {
    color: #667eea;
}

.qualification {
    background: #e8f5e8;
    color: #28a745;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 1rem;
    display: inline-block;
}

.program-description {
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.program-details {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #6c757d;
    font-size: 0.9rem;
}

.detail-item .icon {
    font-size: 1rem;
}

.card-footer {
    padding: 1rem 1.5rem;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
}

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

.btn-primary {
    background: #667eea;
    color: white;
}

.btn-primary:hover {
    background: #5a6fd8;
    transform: translateY(-1px);
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
}

/* Responsive */
@media (max-width: 768px) {
    .hero h1 {
        font-size: 2rem;
    }
    
    .programs-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .program-details {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>
@endpush
