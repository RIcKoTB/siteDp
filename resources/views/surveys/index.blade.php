@extends('layouts.app')

@section('title', 'Опитування')

@section('content')

<!-- Hero Section -->
<section class="hero" style="background-image: url('/storage/images/1.jpg')">
    <div class="hero-overlay">
        <div class="container">
            <h1>📊 Опитування</h1>
            <p>Ваша думка важлива для нас! Допоможіть покращити якість освіти</p>
        </div>
    </div>
</section>

<!-- Surveys Section -->
<section class="surveys-section">
    <div class="container">
        @if($surveys->count() > 0)
            <div class="section-header">
                <h2>Доступні опитування</h2>
                <p>Візьміть участь в опитуваннях та поділіться своєю думкою</p>
            </div>

            <div class="surveys-grid">
                @foreach($surveys as $survey)
                    <div class="survey-card">
                        <div class="card-header">
                            <div class="survey-status {{ $survey->status == 'Активне' ? 'active' : 'inactive' }}">
                                {{ $survey->status }}
                            </div>
                            @if($survey->target_audience)
                                <div class="target-audience">
                                    👥 {{ $survey->target_audience }}
                                </div>
                            @endif
                        </div>

                        <div class="card-body">
                            <h3 class="survey-title">
                                <a href="{{ route('surveys.show', $survey->id) }}">
                                    {{ $survey->title }}
                                </a>
                            </h3>

                            @if($survey->description)
                                <p class="survey-description">
                                    {{ Str::limit($survey->description, 120) }}
                                </p>
                            @endif

                            <div class="survey-details">
                                <div class="detail-item">
                                    <span class="icon">❓</span>
                                    <span>{{ count($survey->questions) }} {{ count($survey->questions) == 1 ? 'питання' : (count($survey->questions) < 5 ? 'питання' : 'питань') }}</span>
                                </div>
                                @if($survey->is_anonymous)
                                    <div class="detail-item">
                                        <span class="icon">🔒</span>
                                        <span>Анонімне</span>
                                    </div>
                                @endif
                                @if($survey->end_date)
                                    <div class="detail-item">
                                        <span class="icon">⏰</span>
                                        <span>До {{ $survey->end_date->format('d.m.Y') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer">
                            @if($survey->is_available)
                                <a href="{{ route('surveys.show', $survey->id) }}" class="btn btn-primary">
                                    Пройти опитування
                                </a>
                            @else
                                <button class="btn btn-disabled" disabled>
                                    Недоступне
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-results">
                <div class="no-results-icon">📊</div>
                <h3>Опитування не знайдено</h3>
                <p>Наразі немає доступних опитувань</p>
            </div>
        @endif
    </div>
</section>

@endsection

@push('styles')
<style>
/* Hero Section */
.hero {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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

/* Surveys Section */
.surveys-section {
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

/* Surveys Grid */
.surveys-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.survey-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.survey-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.card-header {
    padding: 1rem 1.5rem;
    background: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.survey-status {
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
}

.survey-status.active {
    background: #d4edda;
    color: #155724;
}

.survey-status.inactive {
    background: #f8d7da;
    color: #721c24;
}

.target-audience {
    background: #e3f2fd;
    color: #1976d2;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.card-body {
    padding: 1.5rem;
}

.survey-title {
    margin: 0 0 1rem 0;
    font-size: 1.3rem;
    font-weight: 600;
}

.survey-title a {
    color: #2c3e50;
    text-decoration: none;
    transition: color 0.3s ease;
}

.survey-title a:hover {
    color: #28a745;
}

.survey-description {
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.survey-details {
    display: flex;
    flex-wrap: wrap;
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
    width: 100%;
}

.btn-primary {
    background: #28a745;
    color: white;
}

.btn-primary:hover {
    background: #218838;
    transform: translateY(-1px);
}

.btn-disabled {
    background: #6c757d;
    color: white;
    cursor: not-allowed;
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

    .surveys-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .card-header {
        flex-direction: column;
        gap: 0.5rem;
        align-items: flex-start;
    }

    .survey-details {
        flex-direction: column;
        gap: 0.5rem;
    }
}
</style>
@endpush
