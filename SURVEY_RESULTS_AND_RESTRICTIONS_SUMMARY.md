# Результати опитувань в адмін-панелі та обмеження повторного проходження

## 🎯 Завдання
1. **Додати в адмін-панель** перегляд результатів опитувань
2. **Обмежити проходження** опитування до 1 разу на користувача
3. **Показувати статус** "Ви вже проходили це опитування"

## ✅ Реалізовано

### 1. Адмін-панель для результатів опитувань

#### Створено SurveyResponseResource:
```php
class SurveyResponseResource extends Resource
{
    protected static ?string $model = SurveyResponse::class;
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Результати опитувань';
    protected static ?string $navigationGroup = 'Опитування';
}
```

#### Функціонал адмін-панелі:
- **Список всіх відповідей** з фільтрацією
- **Детальний перегляд** кожної відповіді
- **Пошук** по опитуванню та користувачу
- **Фільтри** по даті та опитуванню
- **Статистика** по вкладках (сьогодні, тиждень, місяць)

#### Таблиця результатів:
```php
Tables\Columns\TextColumn::make('survey.title')
    ->label('Опитування')
    ->searchable()
    ->sortable(),

Tables\Columns\TextColumn::make('user.name')
    ->label('Користувач')
    ->searchable()
    ->sortable(),

Tables\Columns\TextColumn::make('user.email')
    ->label('Email')
    ->searchable()
    ->toggleable(),

Tables\Columns\TextColumn::make('created_at')
    ->label('Дата проходження')
    ->dateTime('d.m.Y H:i')
    ->sortable(),
```

#### Детальний перегляд відповідей:
```php
Section::make('Відповіді на питання')
    ->schema([
        TextEntry::make('formatted_answers')
            ->html()
            ->getStateUsing(function (SurveyResponse $record): string {
                // Форматування відповідей з питаннями
                $html = '';
                foreach ($survey->questions as $index => $question) {
                    $answer = $answers[$index] ?? 'Не відповів';
                    $html .= '<div class="answer-block">';
                    $html .= '<h4>' . ($index + 1) . '. ' . $question['question'] . '</h4>';
                    $html .= '<p>' . $answer . '</p>';
                    $html .= '</div>';
                }
                return $html;
            }),
    ]),
```

### 2. Обмеження повторного проходження

#### Додано методи в модель Survey:
```php
// Перевірка, чи користувач вже проходив це опитування
public function hasUserCompleted($userId = null)
{
    $userId = $userId ?? auth()->id();
    
    if (!$userId) {
        return false;
    }
    
    return $this->responses()->where('user_id', $userId)->exists();
}

// Отримати відповідь користувача
public function getUserResponse($userId = null)
{
    $userId = $userId ?? auth()->id();
    
    if (!$userId) {
        return null;
    }
    
    return $this->responses()->where('user_id', $userId)->first();
}
```

#### Оновлено SurveyController:
```php
public function show($id)
{
    $survey = Survey::available()->findOrFail($id);
    
    // Перевіряємо, чи користувач вже проходив це опитування
    $hasCompleted = $survey->hasUserCompleted();
    $userResponse = $survey->getUserResponse();
    
    return view('surveys.show', compact('survey', 'hasCompleted', 'userResponse'));
}

public function submit(Request $request, $id)
{
    $survey = Survey::available()->findOrFail($id);
    
    // Перевіряємо, чи користувач вже проходив це опитування
    if ($survey->hasUserCompleted()) {
        return redirect()->route('surveys.show', $id)
            ->with('error', 'Ви вже проходили це опитування!');
    }
    
    // Решта логіки...
}
```

### 3. UI для завершених опитувань

#### Сторінка "Вже пройдено":
```blade
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
                        <!-- Відображення відповідей користувача -->
                    </div>
                @endif
            </div>
        </div>
    </section>
@elseif($survey->is_available)
    <!-- Форма опитування -->
@endif
```

#### Список опитувань з статусом:
```blade
<div class="card-footer">
    @auth
        @if($survey->hasUserCompleted())
            <div class="completed-status">
                <span class="completed-badge">✅ Пройдено</span>
                <a href="{{ route('surveys.show', $survey->id) }}" class="btn btn-view">
                    Переглянути відповіді
                </a>
            </div>
        @elseif($survey->is_available)
            <a href="{{ route('surveys.show', $survey->id) }}" class="btn btn-primary">
                Пройти опитування
            </a>
        @endif
    @endauth
</div>
```

### 4. Статистика в адмін-панелі

#### Додано лічильник відповідей:
```php
Tables\Columns\TextColumn::make('responses_count')
    ->label('Відповідей')
    ->counts('responses')
    ->badge()
    ->color('success')
    ->sortable(),
```

#### Вкладки з фільтрацією:
```php
public function getTabs(): array
{
    return [
        'all' => Tab::make('Всі відповіді')
            ->badge(fn () => SurveyResponse::count()),
        
        'today' => Tab::make('Сьогодні')
            ->modifyQueryUsing(fn (Builder $query) => $query->whereDate('created_at', today()))
            ->badge(fn () => SurveyResponse::whereDate('created_at', today())->count()),
        
        'this_week' => Tab::make('Цього тижня')
            ->modifyQueryUsing(fn (Builder $query) => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]))
            ->badge(fn () => SurveyResponse::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count()),
        
        'this_month' => Tab::make('Цього місяця')
            ->modifyQueryUsing(fn (Builder $query) => $query->whereMonth('created_at', now()->month))
            ->badge(fn () => SurveyResponse::whereMonth('created_at', now()->month)->count()),
    ];
}
```

### 5. CSS стилізація

#### Стилі для завершеного опитування:
```css
.survey-completed {
    padding: 4rem 0;
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

.completed-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    animation: bounce 2s infinite;
}

.completed-message h2 {
    color: #28a745;
    margin-bottom: 1rem;
    font-size: 1.8rem;
}
```

#### Стилі для статусу в списку:
```css
.completed-status {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    align-items: center;
}

.completed-badge {
    background: #d4edda;
    color: #155724;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    border: 1px solid #c3e6cb;
}

.btn-view {
    background: #17a2b8;
    color: white;
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
}
```

## 🎯 Результат тестування

### Тестові дані:
- **Опитування**: "Оцінка якості освітніх послуг"
- **Користувач**: admin
- **Статус**: Пройдено (18.06.2025 23:15)
- **Кількість відповідей**: 1

### Функціонал працює:
- ✅ **Перевірка завершення**: `$survey->hasUserCompleted()` повертає `true`
- ✅ **Отримання відповіді**: `$survey->getUserResponse()` повертає об'єкт
- ✅ **Статистика**: `$survey->responses()->count()` показує 1
- ✅ **Обмеження повторного проходження**: працює

### Адмін-панель:
- ✅ **Навігація**: "Результати опитувань" в групі "Опитування"
- ✅ **Іконка**: heroicon-o-chart-bar
- ✅ **Таблиця**: з колонками опитування, користувач, дата
- ✅ **Фільтри**: по опитуванню та даті
- ✅ **Детальний перегляд**: з форматованими відповідями

### UI для користувачів:
- ✅ **Список опитувань**: показує статус "✅ Пройдено"
- ✅ **Кнопка**: "Переглянути відповіді" замість "Пройти опитування"
- ✅ **Детальна сторінка**: показує повідомлення про завершення
- ✅ **Відповіді користувача**: відображаються (якщо не анонімне)

## ✅ Статус: ПОВНІСТЮ ГОТОВО

### URL для тестування:
- Адмін-панель результатів: `http://localhost:8000/admin/survey-responses`
- Список опитувань: `http://localhost:8000/surveys`
- Завершене опитування: `http://localhost:8000/surveys/1` (для admin)

Система результатів опитувань та обмеження повторного проходження повністю реалізована! 🚀
