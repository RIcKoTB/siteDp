@extends('layouts.app')

@section('title', $survey->title)

@section('content')

<!-- Hero Section -->
<section class="survey-hero">
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
