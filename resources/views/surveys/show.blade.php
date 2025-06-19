@extends('layouts.app')

@section('title', $survey->title)

@section('content')

<!-- Hero Section -->
<section class="survey-hero" style="background-image: url('/storage/images/1.jpg')">
    <div class="container">
        <div class="hero-content">
            <div class="survey-status {{ $survey->status == 'Активне' ? 'active' : 'inactive' }}">
                {{ $survey->status }}
            </div>

            @auth
                <div class="auth-user-info">
                    <span class="user-icon">👤</span>
                    <span class="user-name">{{ auth()->user()->name }}</span>
                </div>
            @endauth

            <h1>{{ $survey->title }}</h1>

            @if($survey->description)
                <p class="hero-description">{{ $survey->description }}</p>
            @endif

            <div class="survey-meta">
                @if($survey->target_audience)
                    <div class="meta-item">
                        <span class="icon">👥</span>
                        <span>{{ $survey->target_audience }}</span>
                    </div>
                @endif

                @if($survey->is_anonymous)
                    <div class="meta-item">
                        <span class="icon">🔒</span>
                        <span>Анонімне опитування</span>
                    </div>
                @endif

                @if($survey->end_date)
                    <div class="meta-item">
                        <span class="icon">⏰</span>
                        <span>Завершується {{ $survey->end_date->format('d.m.Y о H:i') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Survey Content -->
@if($hasCompleted)
    <section class="survey-completed">
        <div class="container">
            <div class="completed-message">
                <div class="completed-icon">✅</div>
                <h2>Ви вже проходили це опитування</h2>
                <p>Дякуємо за участь! Ви пройшли це опитування {{ $userResponse->created_at->format('d.m.Y о H:i') }}</p>

                <div class="completed-actions">
                    <a href="{{ route('surveys.index') }}" class="btn btn-primary">
                        📋 Переглянути інші опитування
                    </a>
                </div>

                @if($userResponse && !$survey->is_anonymous)
                    <div class="user-answers">
                        <h3>Ваші відповіді:</h3>
                        <div class="answers-list">
                            @foreach($survey->questions as $index => $question)
                                <div class="answer-item">
                                    <h4>{{ $index + 1 }}. {{ $question['question'] }}</h4>
                                    <div class="answer-value">
                                        @if(isset($userResponse->answers[$index]))
                                            @if(is_array($userResponse->answers[$index]))
                                                <ul>
                                                    @foreach($userResponse->answers[$index] as $answer)
                                                        <li>{{ $answer }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p>{{ $userResponse->answers[$index] }}</p>
                                            @endif
                                        @else
                                            <p class="no-answer">Не відповіли</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@elseif($survey->is_available)
    <section class="survey-form-section">
        <div class="container">
            <div class="survey-form-container">
                <form action="{{ route('surveys.submit', $survey->id) }}" method="POST" class="survey-form">
                    @csrf

                    @foreach($survey->questions as $index => $question)
                        <div class="question-block">
                            <div class="question-header">
                                <h3 class="question-title">
                                    {{ $index + 1 }}. {{ $question['question'] }}
                                    @if($question['required'] ?? false)
                                        <span class="required">*</span>
                                    @endif
                                </h3>
                            </div>

                            <div class="question-content">
                                @switch($question['type'])
                                    @case('text')
                                        <input type="text"
                                               name="answers[{{ $index }}]"
                                               class="form-input"
                                               value="{{ old("answers.{$index}", ($question['question'] == 'Ваше ім\'я' || str_contains(strtolower($question['question']), 'ім\'я')) && auth()->check() ? auth()->user()->name : '') }}"
                                               placeholder="Введіть вашу відповідь..."
                                               {{ ($question['required'] ?? false) ? 'required' : '' }}>
                                        @break

                                    @case('textarea')
                                        <textarea name="answers[{{ $index }}]"
                                                  class="form-textarea"
                                                  rows="4"
                                                  placeholder="Введіть вашу відповідь..."
                                                  {{ ($question['required'] ?? false) ? 'required' : '' }}>{{ old("answers.{$index}") }}</textarea>
                                        @break

                                    @case('radio')
                                        <div class="radio-options">
                                            @foreach($question['options'] as $optionIndex => $option)
                                                <label class="radio-option">
                                                    <input type="radio"
                                                           name="answers[{{ $index }}]"
                                                           value="{{ $option }}"
                                                           {{ old("answers.{$index}") == $option ? 'checked' : '' }}
                                                           {{ ($question['required'] ?? false) ? 'required' : '' }}>
                                                    <span class="radio-custom"></span>
                                                    <span class="option-text">{{ $option }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                        @break

                                    @case('checkbox')
                                        <div class="checkbox-options">
                                            @foreach($question['options'] as $optionIndex => $option)
                                                <label class="checkbox-option">
                                                    <input type="checkbox"
                                                           name="answers[{{ $index }}][]"
                                                           value="{{ $option }}"
                                                           {{ is_array(old("answers.{$index}")) && in_array($option, old("answers.{$index}")) ? 'checked' : '' }}>
                                                    <span class="checkbox-custom"></span>
                                                    <span class="option-text">{{ $option }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                        @break

                                    @case('select')
                                        <select name="answers[{{ $index }}]"
                                                class="form-select"
                                                {{ ($question['required'] ?? false) ? 'required' : '' }}>
                                            <option value="">Оберіть варіант...</option>
                                            @foreach($question['options'] as $option)
                                                <option value="{{ $option }}" {{ old("answers.{$index}") == $option ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @break

                                    @case('rating')
                                        <div class="rating-options">
                                            @for($i = 1; $i <= 5; $i++)
                                                <label class="rating-option">
                                                    <input type="radio"
                                                           name="answers[{{ $index }}]"
                                                           value="{{ $i }}"
                                                           {{ old("answers.{$index}") == $i ? 'checked' : '' }}
                                                           {{ ($question['required'] ?? false) ? 'required' : '' }}>
                                                    <span class="rating-star">⭐</span>
                                                    <span class="rating-number">{{ $i }}</span>
                                                </label>
                                            @endfor
                                        </div>
                                        @break

                                    @case('yes_no')
                                        <div class="yes-no-options">
                                            <label class="radio-option">
                                                <input type="radio"
                                                       name="answers[{{ $index }}]"
                                                       value="Так"
                                                       {{ old("answers.{$index}") == 'Так' ? 'checked' : '' }}
                                                       {{ ($question['required'] ?? false) ? 'required' : '' }}>
                                                <span class="radio-custom"></span>
                                                <span class="option-text">✅ Так</span>
                                            </label>
                                            <label class="radio-option">
                                                <input type="radio"
                                                       name="answers[{{ $index }}]"
                                                       value="Ні"
                                                       {{ old("answers.{$index}") == 'Ні' ? 'checked' : '' }}
                                                       {{ ($question['required'] ?? false) ? 'required' : '' }}>
                                                <span class="radio-custom"></span>
                                                <span class="option-text">❌ Ні</span>
                                            </label>
                                        </div>
                                        @break
                                @endswitch
                            </div>
                        </div>
                    @endforeach

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            📤 Надіслати відповіді
                        </button>
                        <a href="{{ route('surveys.index') }}" class="btn btn-secondary">
                            ← Повернутися до списку
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@else
    <section class="survey-unavailable">
        <div class="container">
            <div class="unavailable-message">
                <div class="unavailable-icon">🚫</div>
                <h2>Опитування недоступне</h2>
                <p>
                    @if($survey->status == 'Заплановане')
                        Це опитування ще не розпочалося. Початок: {{ $survey->start_date->format('d.m.Y H:i') }}
                    @elseif($survey->status == 'Завершене')
                        Це опитування вже завершилося {{ $survey->end_date->format('d.m.Y H:i') }}
                    @else
                        Це опитування наразі неактивне
                    @endif
                </p>
                <a href="{{ route('surveys.index') }}" class="btn btn-primary">
                    Переглянути інші опитування
                </a>
            </div>
        </div>
    </section>
@endif

@endsection

@push('styles')
<style>
/* Hero Section */
/* Hero Section */
.survey-hero {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 4rem 0;
    margin-bottom: 3rem;
    position: relative;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.survey-hero::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    z-index: 1;
}

.survey-hero .container {
.survey-status {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.survey-status.active {
    background: rgba(255, 255, 255, 0.3);
    color: white;
}

.survey-status.inactive {
    background: rgba(220, 53, 69, 0.9);
    color: white;
}

.survey-status::before {
    content: "●";
    font-size: 0.7rem;
}
.survey-status::before {
    content: "●";
    font-size: 0.6rem;
}
}
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.survey-status {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.survey-status.active {
    background: rgba(255, 255, 255, 0.3);
    color: white;
}

.survey-status.inactive {
    background: rgba(220, 53, 69, 0.9);
    color: white;
}

.survey-status.active {
    background: rgba(255, 255, 255, 0.3);
    color: white;
}

.survey-status.inactive {
    background: rgba(220, 53, 69, 0.9);
    color: white;
}

.survey-status.active {
    background: rgba(255, 255, 255, 0.3);
    color: white;
}

.auth-user-info {
    background: rgba(255, 255, 255, 0.25);
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    margin-bottom: 1.5rem;
    display: inline-block;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.user-name {
    font-weight: 600;
    color: white;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
}

.user-name {
    font-weight: 600;
    color: white;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
}

.user-icon {
    font-size: 1rem;
    color: #28a745;
}

.user-name {
    font-weight: 600;
    color: #333;
}

.user-icon {
    font-size: 1rem;
}

.user-name {
    font-weight: 500;
    color: white;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}

.user-name {
    font-weight: 600;
    color: white;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
}

.auth-user-info:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-2px);
}

.user-icon {
    font-size: 1.2rem;
    background: rgba(255, 255, 255, 0.2);
    padding: 0.5rem;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.user-name {
    font-weight: 600;
    font-size: 1.1rem;
    color: white;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
}

.survey-hero h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: white;
    text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.8);
    line-height: 1.2;
}

.survey-hero h1::after {
    content: "";
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #ffd700 0%, #ffb347 100%);
    border-radius: 2px;
    box-shadow: 0 2px 10px rgba(255, 215, 0, 0.5);
}

.hero-description {
    font-size: 1.2rem;
    line-height: 1.6;
    color: white;
    margin-bottom: 2rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    opacity: 1;
}

.survey-meta {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 2rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.25);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    color: white;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.meta-item .icon {
    font-size: 1rem;
    color: #28a745;
}

.meta-item .icon {
    font-size: 1rem;
    opacity: 0.9;
}

.meta-item:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.meta-item .icon {
    font-size: 1.2rem;
    background: rgba(255, 255, 255, 0.2);
    padding: 0.5rem;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Survey Completed */
.survey-completed {
    padding: 4rem 0;
}

.survey-completed::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23e9ecef" fill-opacity="0.3"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    opacity: 0.5;
}

.completed-message {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
    background: white;
    padding: 3rem;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.completed-message::before {
    content: "";
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(135deg, #28a745, #20c997, #28a745);
    border-radius: 25px;
    z-index: -1;
    opacity: 0.1;
}

.completed-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0) scale(1);
    }
    40% {
        transform: translateY(-15px) scale(1.1);
    }
    60% {
        transform: translateY(-8px) scale(1.05);
    }
}

.completed-message h2 {
    color: #28a745;
    margin-bottom: 1rem;
    font-size: 1.6rem;
    font-weight: 600;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
}

.completed-message h2::after {
    content: "";
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, #28a745 0%, #20c997 100%);
    border-radius: 2px;
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

.user-answers {
    margin-top: 2rem;
    text-align: left;
}

.user-answers h3 {
    color: #2c3e50;
    margin-bottom: 1rem;
}

.answer-item {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    border-left: 4px solid #28a745;
}

.answer-item h4 {
    color: #495057;
    margin-bottom: 0.5rem;
    font-size: 1rem;
}

.answer-value {
    color: #2c3e50;
    font-weight: 500;
}

.no-answer {
    color: #6c757d;
    font-style: italic;
}

/* Survey Form */
.survey-form-section {
    padding: 2rem 0 4rem;
}

.survey-form-container {
    max-width: 800px;
    margin: 0 auto;
}

.question-block {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border: 1px solid #e9ecef;
}

.question-title {
    color: #2c3e50;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    line-height: 1.4;
}

.required {
    color: #dc3545;
    font-weight: 700;
}

/* Form Elements */
.form-input, .form-textarea, .form-select {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-input:focus, .form-textarea:focus, .form-select:focus {
    outline: none;
    border-color: #28a745;
    box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
}

/* Radio and Checkbox Options */
.radio-option, .checkbox-option {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    margin-bottom: 0.5rem;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.radio-option:hover, .checkbox-option:hover {
    background: #f8f9fa;
}

.radio-custom, .checkbox-custom {
    width: 20px;
    height: 20px;
    border: 2px solid #28a745;
    border-radius: 50%;
    position: relative;
    flex-shrink: 0;
}

.checkbox-custom {
    border-radius: 4px;
}

.radio-option input[type="radio"], .checkbox-option input[type="checkbox"] {
    display: none;
}

.radio-option input[type="radio"]:checked + .radio-custom::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 10px;
    height: 10px;
    background: #28a745;
    border-radius: 50%;
}

.checkbox-option input[type="checkbox"]:checked + .checkbox-custom::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #28a745;
    font-weight: bold;
    font-size: 14px;
}

/* Rating Options */
.rating-options {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.rating-option {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.rating-option:hover {
    background: #f8f9fa;
    transform: translateY(-2px);
}

.rating-option input[type="radio"] {
    display: none;
}

.rating-option input[type="radio"]:checked + .rating-star {
    color: #ffc107;
    transform: scale(1.2);
}

.rating-star {
    font-size: 2rem;
    transition: all 0.3s ease;
    filter: grayscale(100%);
}

.rating-option:hover .rating-star,
.rating-option input[type="radio"]:checked + .rating-star {
    filter: grayscale(0%);
}

/* Yes/No Options */
.yes-no-options {
    display: flex;
    gap: 2rem;
    justify-content: center;
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 3rem;
}

.btn {
    display: inline-block;
    padding: 0.75rem 2rem;
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
    transform: translateY(-1px);
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-1px);
}

/* Survey Unavailable */
.survey-unavailable {
    padding: 4rem 0;
}

.unavailable-message {
    text-align: center;
    max-width: 600px;
    margin: 0 auto;
    background: white;
    padding: 3rem;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.unavailable-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

/* Responsive */
@media (max-width: 768px) {
.survey-hero h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: white;
    text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.8);
    line-height: 1.2;
}

.survey-hero h1::after {
    content: "";
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #ffd700 0%, #ffb347 100%);
    border-radius: 2px;
    box-shadow: 0 2px 10px rgba(255, 215, 0, 0.5);
}

.survey-meta {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 2rem;
}

    .question-block {
        padding: 1.5rem;
    }

    .rating-options {
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .yes-no-options {
        flex-direction: column;
        gap: 1rem;
    }

    .form-actions {
        flex-direction: column;
    }
}
</style>
@endpush


