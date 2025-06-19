@extends('layouts.app')

@section('title', 'Опитування')

@section('content')

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>📋 Доступні опитування</h1>
            <p>Ваша думка важлива для нас! Візьміть участь в опитуваннях та допоможіть покращити якість освіти</p>
            
            @auth
                <div class="user-info">
                    <span class="user-greeting">👋 Вітаємо, {{ auth()->user()->name }}!</span>
                </div>
            @else
                <div class="auth-notice">
                    <p>🔐 Для участі в опитуваннях необхідно <a href="{{ route('login') }}">увійти в систему</a></p>
                </div>
            @endauth
        </div>
    </div>
</section>

<!-- Surveys List -->
<section class="surveys-section">
    <div class="container">
        @if($surveys->count() > 0)
            <div class="surveys-grid">
                @foreach($surveys as $survey)
                    <div class="survey-card {{ isset($survey->user_completed) && $survey->user_completed ? 'completed' : '' }}">
                        <div class="survey-header">
                            <div class="survey-status {{ $survey->status == 'Активне' ? 'active' : 'inactive' }}">
                                {{ $survey->status }}
                            </div>
                            
                            @if(isset($survey->user_completed) && $survey->user_completed)
                                <div class="completion-badge">
                                    ✅ Пройдено
                                </div>
                            @endif
                        </div>
                        
                        <div class="survey-content">
                            <h3 class="survey-title">{{ $survey->title }}</h3>
                            
                            @if($survey->description)
                                <p class="survey-description">{{ Str::limit($survey->description, 120) }}</p>
                            @endif
                            
                            <div class="survey-meta">
                                @if($survey->target_audience)
                                    <div class="meta-item">
                                        <span class="icon">👥</span>
                                        <span>{{ $survey->target_audience }}</span>
                                    </div>
                                @endif
                                
                                <div class="meta-item">
                                    <span class="icon">❓</span>
                                    <span>{{ count($survey->questions) }} {{ count($survey->questions) == 1 ? 'питання' : (count($survey->questions) < 5 ? 'питання' : 'питань') }}</span>
                                </div>
                                
                                @if($survey->is_anonymous)
                                    <div class="meta-item">
                                        <span class="icon">🔒</span>
                                        <span>Анонімне</span>
                                    </div>
                                @endif
                                
                                @if($survey->end_date)
                                    <div class="meta-item">
                                        <span class="icon">⏰</span>
                                        <span>До {{ $survey->end_date->format('d.m.Y') }}</span>
                                    </div>
                                @endif
                                
                                <div class="meta-item">
                                    <span class="icon">📊</span>
                                    <span>{{ $survey->responses_count }} {{ $survey->responses_count == 1 ? 'відповідь' : ($survey->responses_count < 5 ? 'відповіді' : 'відповідей') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="survey-actions">
                            @auth
                                @if(isset($survey->user_completed) && $survey->user_completed)
                                    <a href="{{ route('surveys.show', $survey->id) }}" class="btn btn-secondary">
                                        👁️ Переглянути результат
                                    </a>
                                @else
                                    <a href="{{ route('surveys.show', $survey->id) }}" class="btn btn-primary">
                                        📝 Пройти опитування
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline">
                                    🔐 Увійти для участі
                                </a>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-surveys">
                <div class="no-surveys-icon">📋</div>
                <h3>Наразі немає доступних опитувань</h3>
                <p>Слідкуйте за оновленнями - незабаром з'являться нові опитування!</p>
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

.hero-content {
    max-width: 800px;
    margin: 0 auto;
}

.hero h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.hero p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.user-info {
    background: rgba(255, 255, 255, 0.15);
    padding: 1rem 2rem;
    border-radius: 25px;
    display: inline-block;
}

.user-greeting {
    font-weight: 600;
    font-size: 1.1rem;
}

.auth-notice {
    background: rgba(255, 255, 255, 0.1);
    padding: 1rem 2rem;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.auth-notice a {
    color: white;
    text-decoration: underline;
    font-weight: 600;
}

/* Surveys Section */
.surveys-section {
    padding: 2rem 0 4rem;
}

.surveys-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
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

.survey-card.completed {
    border-color: #28a745;
    background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%);
}

.survey-header {
    padding: 1.5rem 1.5rem 0;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.survey-status {
    padding: 0.25rem 0.75rem;
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

.completion-badge {
    background: #28a745;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
}

.survey-content {
    padding: 1rem 1.5rem;
}

.survey-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.75rem;
    line-height: 1.4;
}

.survey-description {
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.survey-meta {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 0.5rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: #495057;
}

.meta-item .icon {
    font-size: 1rem;
}

.survey-actions {
    padding: 1rem 1.5rem 1.5rem;
    border-top: 1px solid #e9ecef;
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

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
}

.btn-outline {
    background: transparent;
    color: #28a745;
    border: 2px solid #28a745;
}

.btn-outline:hover {
    background: #28a745;
    color: white;
}

/* No Surveys */
.no-surveys {
    text-align: center;
    padding: 4rem 2rem;
}

.no-surveys-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.no-surveys h3 {
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.no-surveys p {
    color: #6c757d;
}

/* Responsive */
@media (max-width: 768px) {
    .hero h1 {
        font-size: 2rem;
    }
    
    .surveys-grid {
        grid-template-columns: 1fr;
    }
    
    .survey-meta {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush
