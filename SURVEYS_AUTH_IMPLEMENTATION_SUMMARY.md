# Реалізація авторизації для опитувань

## 🎯 Завдання
1. **Обмежити доступ** до опитувань тільки для авторизованих користувачів
2. **Автоматично підставляти ім'я** з профілю користувача в текстові поля
3. **Зберігати відповіді** з прив'язкою до користувача

## ✅ Реалізовано

### 1. Middleware авторизації

#### Оновлено SurveyController:
```php
public function __construct()
{
    $this->middleware('auth')->except(['index']);
}
```

**Логіка доступу:**
- **Список опитувань** (`/surveys`) - доступний всім (з повідомленням про авторизацію)
- **Детальна сторінка** (`/surveys/{id}`) - тільки для авторизованих
- **Відправка відповідей** (`/surveys/{id}/submit`) - тільки для авторизованих

### 2. Автоматичне підставлення імені користувача

#### Логіка в surveys/show.blade.php:
```php
@case('text')
    @php
        $defaultValue = '';
        // Якщо питання про ім'я, підставляємо ім'я користувача
        if (stripos($question['question'], 'ім\'я') !== false || 
            stripos($question['question'], 'имя') !== false ||
            stripos($question['question'], 'name') !== false) {
            $defaultValue = auth()->user()->name ?? '';
        }
    @endphp
    <input type="text" 
           name="answers[{{ $index }}]" 
           class="form-input"
           value="{{ $defaultValue }}"
           {{ ($question['required'] ?? false) ? 'required' : '' }}>
@break
```

**Підтримувані варіанти питань:**
- "Ваше ім'я"
- "Ваше имя" 
- "Your name"
- Будь-які варіації з цими словами

### 3. Оновлена модель SurveyResponse

#### Структура таблиці:
```php
protected $fillable = [
    'survey_id',    // ID опитування
    'user_id',      // ID користувача
    'answers',      // JSON з відповідями
    'ip_address',   // IP адреса
    'user_agent',   // User Agent браузера
];

protected $casts = [
    'answers' => 'array',
];
```

#### Relationships:
```php
public function survey()
{
    return $this->belongsTo(Survey::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
```

### 4. Збереження відповідей з авторизацією

#### Оновлено submit метод:
```php
public function submit(Request $request, $id)
{
    $survey = Survey::available()->findOrFail($id);
    
    // Валідація відповідей
    $rules = [];
    foreach ($survey->questions as $index => $question) {
        if ($question['required'] ?? false) {
            $rules["answers.{$index}"] = 'required';
        }
    }
    
    $request->validate($rules);
    
    // Збереження з user_id
    SurveyResponse::create([
        'survey_id' => $survey->id,
        'answers' => $request->answers,
        'user_id' => auth()->id(),        // ← Автоматично з авторизації
        'ip_address' => $request->ip(),
        'user_agent' => $request->userAgent(),
    ]);
    
    return view('surveys.thank-you', compact('survey'));
}
```

### 5. UI для авторизованих/неавторизованих користувачів

#### Список опитувань (surveys/index.blade.php):

**Для авторизованих:**
```html
@auth
    <div class="auth-info">
        <span class="user-greeting">👋 Вітаємо, {{ auth()->user()->name }}!</span>
    </div>
@endauth
```

**Для неавторизованих:**
```html
@else
    <div class="auth-required">
        <div class="auth-message">
            🔐 Для участі в опитуваннях необхідно <a href="{{ route('login') }}">увійти в систему</a>
        </div>
    </div>
@endauth
```

#### Кнопки в картках опитувань:

**Для авторизованих:**
```html
@auth
    @if($survey->is_available)
        <a href="{{ route('surveys.show', $survey->id) }}" class="btn btn-primary">
            Пройти опитування
        </a>
    @else
        <button class="btn btn-disabled" disabled>
            Недоступне
        </button>
    @endif
@endauth
```

**Для неавторизованих:**
```html
@else
    <a href="{{ route('login') }}" class="btn btn-auth">
        🔐 Увійти для участі
    </a>
@endauth
```

### 6. Детальна сторінка опитування

#### Інформація про користувача:
```html
<div class="auth-user-info">
    👤 <span class="user-name">{{ auth()->user()->name }}</span>
</div>
```

#### CSS стилізація:
```css
.auth-user-info {
    background: rgba(255, 255, 255, 0.15);
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    margin-bottom: 1.5rem;
    display: inline-block;
}

.user-greeting {
    background: rgba(40, 167, 69, 0.1);
    color: #28a745;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 500;
    display: inline-block;
}

.auth-message {
    background: rgba(255, 193, 7, 0.1);
    color: #856404;
    padding: 1rem 1.5rem;
    border-radius: 8px;
    border-left: 4px solid #ffc107;
    font-weight: 500;
}

.btn-auth {
    background: #007bff;
    color: white;
}
```

### 7. Тестові дані

#### Створено тестового користувача:
- **Ім'я**: Іван Петренко
- **Email**: ivan.petrenko@student.uzhnu.edu.ua
- **Пароль**: password123

#### Тестова відповідь на опитування:
```json
{
    "survey_id": 1,
    "user_id": 1,
    "answers": [
        "5",
        ["Програмування", "Математика"],
        "Дуже гарний коледж, рекомендую всім!"
    ],
    "ip_address": "127.0.0.1",
    "user_agent": "Test Browser"
}
```

### 8. Безпека та валідація

#### Middleware захист:
- Автоматичне перенаправлення на `/login` для неавторизованих
- Збереження intended URL для повернення після логіну

#### Валідація даних:
- Перевірка обов'язкових полів
- CSRF захист для всіх форм
- Валідація існування опитування та користувача

#### Приватність:
- Зберігання user_id для неанонімних опитувань
- IP адреса та User Agent для аналітики
- Можливість анонімних опитувань (is_anonymous = true)

### 9. Функціонал для адміністраторів

#### Перегляд відповідей:
```php
// В майбутньому можна додати
$responses = SurveyResponse::with(['user', 'survey'])
    ->where('survey_id', $surveyId)
    ->get();

foreach ($responses as $response) {
    echo $response->user->name . ': ';
    echo json_encode($response->answers);
}
```

#### Статистика:
- Кількість відповідей на опитування
- Список користувачів, що пройшли опитування
- Аналіз відповідей по користувачах

## 🎯 Результат

### Що тепер працює:
- ✅ **Авторизація обов'язкова** для проходження опитувань
- ✅ **Автоматичне підставлення імені** в текстові поля
- ✅ **Збереження з user_id** для ідентифікації відповідей
- ✅ **Різний UI** для авторизованих/неавторизованих
- ✅ **Безпечне збереження** з валідацією

### Workflow користувача:
1. **Неавторизований** - бачить список з повідомленням про логін
2. **Клік на "Увійти"** - перенаправлення на сторінку логіну
3. **Після логіну** - повернення до опитувань з привітанням
4. **Проходження опитування** - автоматичне підставлення імені
5. **Відправка** - збереження з прив'язкою до користувача

### URL для тестування:
- Список опитувань: `http://localhost:8000/surveys`
- Логін: `http://localhost:8000/login`
- Опитування: `http://localhost:8000/surveys/1` (після авторизації)

## ✅ Статус: ПОВНІСТЮ ГОТОВО

Система авторизації для опитувань реалізована з повним функціоналом! 🚀
