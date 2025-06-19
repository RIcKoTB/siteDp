@extends('layouts.app')

@section('title', 'Дякуємо за участь!')

@section('content')

<!-- Thank You Section -->
<section class="thank-you-section">
    <div class="container">
        <div class="thank-you-container">
            <div class="thank-you-icon">
                ✅
            </div>
            
            <h1>Дякуємо за участь!</h1>
            
            <div class="survey-info">
                <h2>{{ $survey->title }}</h2>
                @if($survey->description)
                    <p class="survey-description">{{ $survey->description }}</p>
                @endif
            </div>
            
            <div class="thank-you-message">
                @if($survey->thank_you_message)
                    <p>{{ $survey->thank_you_message }}</p>
                @else
                    <p>Дякуємо за участь в опитуванні! Ваші відповіді допоможуть нам покращити якість освіти.</p>
                @endif
            </div>
            
            <div class="completion-stats">
                <div class="stat-item">
                    <span class="stat-icon">📊</span>
                    <span class="stat-text">Опитування завершено</span>
                </div>
                <div class="stat-item">
                    <span class="stat-icon">⏰</span>
                    <span class="stat-text">{{ now()->format('d.m.Y H:i') }}</span>
                </div>
                @if($survey->is_anonymous)
                    <div class="stat-item">
                        <span class="stat-icon">🔒</span>
                        <span class="stat-text">Анонімно</span>
                    </div>
                @endif
            </div>
            
            <div class="action-buttons">
                <a href="{{ route('surveys.index') }}" class="btn btn-primary">
                    📋 Переглянути інші опитування
                </a>
                <a href="{{ route('home') }}" class="btn btn-secondary">
                    🏠 На головну сторінку
                </a>
            </div>
            
            <div class="additional-info">
                <h3>Що далі?</h3>
                <ul>
                    <li>Ваші відповіді будуть проаналізовані нашою командою</li>
                    <li>Результати опитування допоможуть покращити освітні програми</li>
                    <li>Ви можете взяти участь в інших доступних опитуваннях</li>
                    @if(!$survey->is_anonymous)
                        <li>За потреби ми можемо зв'язатися з вами для уточнень</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
/* Thank You Section */
.thank-you-section {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 4rem 0;
}

.thank-you-container {
    max-width: 600px;
    margin: 0 auto;
    background: white;
    border-radius: 20px;
    padding: 3rem;
    text-align: center;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.thank-you-icon {
    font-size: 5rem;
    margin-bottom: 1.5rem;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

.thank-you-container h1 {
    color: #28a745;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 2rem;
}

.survey-info {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 12px;
    margin-bottom: 2rem;
}

.survey-info h2 {
    color: #2c3e50;
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.survey-description {
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.5;
}

.thank-you-message {
    background: linear-gradient(135deg, #e8f5e8 0%, #d4edda 100%);
    padding: 1.5rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    border-left: 4px solid #28a745;
}

.thank-you-message p {
    color: #155724;
    font-size: 1.1rem;
    line-height: 1.6;
    margin: 0;
    font-weight: 500;
}

.completion-stats {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-bottom: 2.5rem;
    flex-wrap: wrap;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: #f8f9fa;
    padding: 0.75rem 1rem;
    border-radius: 20px;
    color: #6c757d;
    font-size: 0.9rem;
    font-weight: 500;
}

.stat-icon {
    font-size: 1.1rem;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-bottom: 3rem;
    flex-wrap: wrap;
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
    font-size: 1rem;
}

.btn-primary {
    background: #28a745;
    color: white;
}

.btn-primary:hover {
    background: #218838;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
}

.additional-info {
    text-align: left;
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 12px;
    border: 1px solid #e9ecef;
}

.additional-info h3 {
    color: #2c3e50;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1rem;
    text-align: center;
}

.additional-info ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.additional-info li {
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 0.75rem;
    padding-left: 1.5rem;
    position: relative;
}

.additional-info li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: #28a745;
    font-weight: bold;
}

/* Responsive */
@media (max-width: 768px) {
    .thank-you-container {
        margin: 1rem;
        padding: 2rem;
    }
    
    .thank-you-container h1 {
        font-size: 2rem;
    }
    
    .thank-you-icon {
        font-size: 4rem;
    }
    
    .completion-stats {
        flex-direction: column;
        gap: 1rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .additional-info {
        padding: 1.5rem;
    }
}

/* Success Animation */
.thank-you-container {
    animation: slideInUp 0.8s ease-out;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endpush
