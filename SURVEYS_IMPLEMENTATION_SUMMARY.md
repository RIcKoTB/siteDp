# Реалізація сторінки опитувань

## 🎯 Завдання
Реалізувати повний функціонал сторінки опитувань так, як було раніше.

## ✅ Реалізовано

### 1. Оновлено SurveyController

#### Повний функціонал контролера:
```php
class SurveyController extends Controller
{
    public function index()
    {
        // Отримуємо доступні опитування з інформацією про завершення
        $surveys = Survey::available()->ordered()->get();
        
        if (Auth::check()) {
            foreach ($surveys as $survey) {
                $survey->user_completed = $survey->hasUserCompleted();
            }
        }
    }

    public function show($id)
    {
        // Перевірка авторизації та завершення опитування
        $hasCompleted = $survey->hasUserCompleted();
        $userResponse = $hasCompleted ? $survey->getUserResponse() : null;
    }

    public function submit(Request $request, $id)
    {
        // Валідація, збереження відповідей, перевірка дублікатів
    }
}
```

#### Функціонал:
- **Перевірка авторизації** - тільки авторизовані користувачі
- **Перевірка завершення** - запобігання повторному проходженню
- **Валідація відповідей** - обов'язкові поля
- **Збереження результатів** - в SurveyResponse

### 2. Розширено модель Survey

#### Додані методи:
```php
// Scopes
public function scopeAvailable(Builder $query): Builder
public function scopeOrdered(Builder $query): Builder

// Relationships
public function responses()

// Helper methods
public function hasUserCompleted($userId = null): bool
public function getUserResponse($userId = null)
public function getStatusAttribute(): string
public function getIsAvailableAttribute(): bool
public function getResponsesCountAttribute(): int
```

#### Функціонал:
- **Перевірка доступності** опитування (дати, активність)
- **Перевірка завершення** користувачем
- **Отримання відповідей** користувача
- **Підрахунок статистики** відповідей

### 3. Створено view surveys/index.blade.php

#### Hero секція:
```html
<section class="hero">
    <h1>📋 Доступні опитування</h1>
    <p>Ваша думка важлива для нас!</p>
    
    @auth
        <div class="user-info">👋 Вітаємо, {{ auth()->user()->name }}!</div>
    @else
        <div class="auth-notice">🔐 Для участі необхідно увійти</div>
    @endauth
</section>
```

#### Картки опитувань:
```html
<div class="survey-card {{ $survey->user_completed ? 'completed' : '' }}">
    <div class="survey-header">
        <div class="survey-status">{{ $survey->status }}</div>
        @if($survey->user_completed)
            <div class="completion-badge">✅ Пройдено</div>
        @endif
    </div>
    
    <div class="survey-content">
        <h3>{{ $survey->title }}</h3>
        <p>{{ $survey->description }}</p>
        
        <div class="survey-meta">
            <span>👥 {{ $survey->target_audience }}</span>
            <span>❓ {{ count($survey->questions) }} питань</span>
            <span>🔒 Анонімне</span>
            <span>⏰ До {{ $survey->end_date }}</span>
            <span>📊 {{ $survey->responses_count }} відповідей</span>
        </div>
    </div>
    
    <div class="survey-actions">
        @if($survey->user_completed)
            <a href="{{ route('surveys.show', $survey->id) }}">👁️ Переглянути результат</a>
        @else
            <a href="{{ route('surveys.show', $survey->id) }}">📝 Пройти опитування</a>
        @endif
    </div>
</div>
```

### 4. Створено view surveys/show.blade.php

#### Hero секція з інформацією:
```html
<section class="survey-hero">
    <div class="survey-status">{{ $survey->status }}</div>
    <div class="auth-user-info">👤 {{ auth()->user()->name }}</div>
    <h1>{{ $survey->title }}</h1>
    <p>{{ $survey->description }}</p>
    
    <div class="survey-meta">
        <span>👥 {{ $survey->target_audience }}</span>
        <span>🔒 Анонімне опитування</span>
        <span>⏰ Завершується {{ $survey->end_date }}</span>
    </div>
</section>
```

#### Три стани сторінки:

**1. Завершене опитування:**
```html
<section class="survey-completed">
    <div class="completed-icon">✅</div>
    <h2>Ви вже проходили це опитування</h2>
    <p>Пройдено {{ $userResponse->created_at->format('d.m.Y о H:i') }}</p>
    
    @if(!$survey->is_anonymous)
        <div class="user-answers">
            <!-- Відображення відповідей користувача -->
        </div>
    @endif
</section>
```

**2. Доступне опитування (форма):**
```html
<section class="survey-form-section">
    <form action="{{ route('surveys.submit', $survey->id) }}" method="POST">
        @foreach($survey->questions as $index => $question)
            <div class="question-block">
                <h3>{{ $index + 1 }}. {{ $question['question'] }}
                    @if($question['required']) <span class="required">*</span> @endif
                </h3>
                
                @switch($question['type'])
                    @case('text')
                        <input type="text" name="answers[{{ $index }}]">
                    @case('textarea')
                        <textarea name="answers[{{ $index }}]"></textarea>
                    @case('radio')
                        <!-- Radio опції -->
                    @case('checkbox')
                        <!-- Checkbox опції -->
                    @case('select')
                        <!-- Select dropdown -->
                    @case('rating')
                        <!-- 5-зіркова оцінка -->
                    @case('yes_no')
                        <!-- Так/Ні опції -->
                @endswitch
            </div>
        @endforeach
        
        <button type="submit">📤 Надіслати відповіді</button>
    </form>
</section>
```

**3. Недоступне опитування:**
```html
<section class="survey-unavailable">
    <div class="unavailable-icon">🚫</div>
    <h2>Опитування недоступне</h2>
    <p>Причина недоступності...</p>
</section>
```

### 5. Типи питань

#### Підтримувані типи:
1. **text** - текстове поле
2. **textarea** - багаторядкове поле
3. **radio** - вибір одного варіанту
4. **checkbox** - вибір кількох варіантів
5. **select** - випадаючий список
6. **rating** - 5-зіркова оцінка
7. **yes_no** - Так/Ні

#### Особливості:
- **Автозаповнення імені** для авторизованих користувачів
- **Валідація обов'язкових полів**
- **Збереження стану** при помилках валідації
- **Кастомні стилі** для radio/checkbox

### 6. Система обмежень

#### Обмеження доступу:
- **Тільки авторизовані користувачі** можуть проходити опитування
- **Одноразове проходження** - запобігання дублікатам
- **Перевірка дат** - start_date та end_date
- **Перевірка активності** - is_active

#### Повідомлення:
- **Успішне завершення** - "Дякуємо за участь!"
- **Повторне проходження** - "Ви вже проходили це опитування"
- **Неавторизований доступ** - перенаправлення на логін

### 7. Дизайн та стилізація

#### Кольорова схема:
- **Основний градієнт**: #28a745 → #20c997 (зелений)
- **Завершені опитування**: зелена рамка та фон
- **Статуси**: зелений (активне), червоний (неактивне)

#### Компоненти:
- **Анімована іконка** ✅ для завершених опитувань
- **Hover ефекти** на картках та кнопках
- **Кастомні radio/checkbox** з анімацією
- **5-зіркова оцінка** з hover ефектами

#### Адаптивність:
- **Мобільна версія** (768px breakpoint)
- **Гнучкі сітки** для карток
- **Стекування елементів** на малих екранах

### 8. Функціонал форми

#### Валідація:
```php
$rules = [];
foreach ($survey->questions as $index => $question) {
    if ($question['required'] ?? false) {
        $rules["answers.{$index}"] = 'required';
    }
}
```

#### Збереження:
```php
SurveyResponse::create([
    'survey_id' => $survey->id,
    'user_id' => Auth::id(),
    'answers' => $request->answers ?? [],
    'ip_address' => $request->ip(),
    'user_agent' => $request->userAgent(),
    'completed_at' => now(),
]);
```

## 🎯 Результат тестування

### URL для тестування:
- **Список опитувань**: `http://localhost:8001/surveys`
- **Детальна сторінка**: `http://localhost:8001/surveys/1`
- **Сервер запускається**: `php artisan serve --port=8001`

### Функціонал працює:
- ✅ **Відображення списку** опитувань
- ✅ **Перевірка авторизації** користувачів
- ✅ **Форма опитування** з різними типами питань
- ✅ **Валідація та збереження** відповідей
- ✅ **Запобігання повторному проходженню**
- ✅ **Відображення результатів** для завершених опитувань

## ✅ Статус: СТОРІНКА ОПИТУВАНЬ РЕАЛІЗОВАНА

Повний функціонал сторінки опитувань відновлено з усіма можливостями! 🚀
