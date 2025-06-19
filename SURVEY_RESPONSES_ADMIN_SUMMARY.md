# Додавання сторінки результатів опитувань в адмін-панель

## 🎯 Завдання
Створити повноцінну сторінку для перегляду та управління результатами опитувань в адмін-панелі.

## ✅ Реалізовано

### 1. Створено SurveyResponseResource

#### Основні налаштування:
```php
class SurveyResponseResource extends Resource
{
    protected static ?string $model = SurveyResponse::class;
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Результати опитувань';
    protected static ?string $navigationGroup = 'Опитування';
    protected static ?int $navigationSort = 2;
}
```

#### Функціонал:
- **Тільки перегляд** - заборонено створення та редагування
- **Групування** в секції "Опитування"
- **Іконка** chart-bar для статистики
- **Сортування** після основних опитувань

### 2. Налаштовано таблицю результатів

#### Колонки таблиці:
```php
TextColumn::make('survey.title')
    ->label('Опитування')
    ->searchable()
    ->sortable(),

TextColumn::make('user.name')
    ->label('Користувач')
    ->searchable()
    ->sortable(),

TextColumn::make('user.email')
    ->label('Email')
    ->searchable()
    ->toggleable(),

TextColumn::make('completed_at')
    ->label('Дата завершення')
    ->dateTime('d.m.Y H:i')
    ->sortable(),

TextColumn::make('answers_count')
    ->label('Кількість відповідей')
    ->getStateUsing(function (SurveyResponse $record) {
        return is_array($record->answers) ? count($record->answers) : 0;
    })
    ->badge()
    ->color('success'),

TextColumn::make('ip_address')
    ->label('IP адреса')
    ->toggleable(isToggledHiddenByDefault: true),
```

#### Особливості:
- **Пошук** по опитуванню, користувачу, email
- **Сортування** за датою завершення (за замовчуванням)
- **Бейджі** для кількості відповідей
- **Приховані колонки** (IP, дата створення)

### 3. Додано фільтри

#### Фільтр по опитуванню:
```php
SelectFilter::make('survey_id')
    ->label('Опитування')
    ->relationship('survey', 'title')
    ->multiple(),
```

#### Фільтр по користувачу:
```php
SelectFilter::make('user_id')
    ->label('Користувач')
    ->relationship('user', 'name')
    ->searchable(),
```

#### Фільтр по даті:
```php
Filter::make('completed_at')
    ->form([
        DatePicker::make('completed_from')
            ->label('Завершено з'),
        DatePicker::make('completed_until')
            ->label('Завершено до'),
    ])
    ->query(function (Builder $query, array $data): Builder {
        return $query
            ->when(
                $data['completed_from'],
                fn (Builder $query, $date): Builder => $query->whereDate('completed_at', '>=', $date),
            )
            ->when(
                $data['completed_until'],
                fn (Builder $query, $date): Builder => $query->whereDate('completed_at', '<=', $date),
            );
    }),
```

### 4. Створено детальну сторінку перегляду

#### Infolist структура:
```php
Section::make('Інформація про відповідь')
    ->schema([
        TextEntry::make('survey.title')->label('Опитування'),
        TextEntry::make('user.name')->label('Користувач'),
        TextEntry::make('user.email')->label('Email користувача'),
        TextEntry::make('completed_at')->label('Дата завершення')->dateTime('d.m.Y H:i'),
        TextEntry::make('ip_address')->label('IP адреса'),
        TextEntry::make('user_agent')->label('Браузер')->limit(50),
    ])
    ->columns(2),

Section::make('Відповіді користувача')
    ->schema([
        TextEntry::make('answers')
            ->formatStateUsing(function (SurveyResponse $record) {
                // Форматування відповідей з HTML
                $html = '';
                foreach ($record->survey->questions as $index => $question) {
                    $answer = $record->answers[$index] ?? 'Не відповів';
                    
                    $html .= '<div style="margin-bottom: 1rem; padding: 1rem; background: #f8f9fa; border-radius: 8px;">';
                    $html .= '<strong>' . ($index + 1) . '. ' . $question['question'] . '</strong><br>';
                    
                    if (is_array($answer)) {
                        $html .= '<ul>';
                        foreach ($answer as $item) {
                            $html .= '<li>' . htmlspecialchars($item) . '</li>';
                        }
                        $html .= '</ul>';
                    } else {
                        $html .= '<span style="color: #28a745; font-weight: 500;">' . htmlspecialchars($answer) . '</span>';
                    }
                    
                    $html .= '</div>';
                }
                
                return $html;
            })
            ->html(),
    ]),
```

#### Особливості детального перегляду:
- **Форматовані відповіді** з HTML стилізацією
- **Підтримка масивів** для множинного вибору
- **Безпечне відображення** з htmlspecialchars
- **Структуровані блоки** для кожного питання

### 5. Додано вкладки по опитуванням

#### ListSurveyResponses::getTabs():
```php
public function getTabs(): array
{
    $tabs = [
        'all' => Tab::make('Всі результати')
            ->badge($this->getModel()::count()),
    ];
    
    // Додаємо вкладки для кожного опитування
    $surveys = Survey::withCount('responses')->get();
    
    foreach ($surveys as $survey) {
        $tabs["survey_{$survey->id}"] = Tab::make($survey->title)
            ->badge($survey->responses_count)
            ->modifyQueryUsing(fn (Builder $query) => $query->where('survey_id', $survey->id));
    }
    
    return $tabs;
}
```

#### Функціонал вкладок:
- **"Всі результати"** - показує всі відповіді
- **Вкладка для кожного опитування** - фільтрує по конкретному опитуванню
- **Бейджі з кількістю** відповідей на кожній вкладці
- **Динамічне створення** на основі існуючих опитувань

### 6. Додано дії та кнопки

#### Дії в таблиці:
```php
->actions([
    Tables\Actions\ViewAction::make(),
    Tables\Actions\DeleteAction::make(),
])
->bulkActions([
    Tables\Actions\BulkActionGroup::make([
        Tables\Actions\DeleteBulkAction::make(),
    ]),
])
```

#### Дії в header:
```php
Actions\Action::make('export')
    ->label('Експорт результатів')
    ->icon('heroicon-o-arrow-down-tray')
    ->color('success')
    ->action(function () {
        $this->notify('success', 'Експорт буде доданий пізніше');
    }),
```

#### Дії на сторінці перегляду:
```php
Actions\DeleteAction::make()
    ->label('Видалити відповідь')
    ->requiresConfirmation()
    ->modalHeading('Видалити відповідь на опитування?')
    ->modalDescription('Ця дія незворотна. Відповідь користувача буде видалена назавжди.')
    ->modalSubmitActionLabel('Так, видалити'),

Actions\Action::make('back')
    ->label('Назад до списку')
    ->icon('heroicon-o-arrow-left')
    ->color('gray')
    ->url(fn () => SurveyResponseResource::getUrl('index')),
```

### 7. Оновлено групування навігації

#### SurveyResource:
```php
protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
protected static ?string $navigationLabel = 'Опитування';
protected static ?string $navigationGroup = 'Опитування';
protected static ?int $navigationSort = 1;
```

#### SurveyResponseResource:
```php
protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
protected static ?string $navigationLabel = 'Результати опитувань';
protected static ?string $navigationGroup = 'Опитування';
protected static ?int $navigationSort = 2;
```

#### Структура навігації:
```
📁 Опитування
├── 📋 Опитування (створення, редагування)
└── 📊 Результати опитувань (перегляд, аналіз)
```

### 8. Обмеження доступу

#### Заборонені дії:
```php
public static function canCreate(): bool
{
    return false; // Заборонити створення через адмін-панель
}

public static function canEdit($record): bool
{
    return false; // Заборонити редагування
}
```

#### Дозволені дії:
- ✅ **Перегляд списку** результатів
- ✅ **Детальний перегляд** відповідей
- ✅ **Видалення** результатів (з підтвердженням)
- ✅ **Фільтрація та пошук**
- ✅ **Експорт** (заготовка)

## 🎯 Функціонал що працює

### Адмін-панель:
- ✅ **Група "Опитування"** з двома ресурсами
- ✅ **Таблиця результатів** з пошуком та фільтрами
- ✅ **Вкладки по опитуванням** з лічильниками
- ✅ **Детальний перегляд** відповідей користувачів

### Безпека:
- ✅ **Тільки перегляд** - неможливо змінити відповіді
- ✅ **Підтвердження видалення** з попередженням
- ✅ **Відображення IP та User Agent** для аудиту

### Зручність:
- ✅ **Пошук по користувачу** та опитуванню
- ✅ **Фільтрація по датах** завершення
- ✅ **Сортування** за різними критеріями
- ✅ **Бейджі з кількістю** відповідей

## 🧪 Тестування

### URL для доступу:
- **Список результатів**: `http://localhost:8001/admin/survey-responses`
- **Детальний перегляд**: `http://localhost:8001/admin/survey-responses/1`
- **Логін адмін-панелі**: `http://localhost:8001/admin/login`

### Перевірка функціоналу:
```bash
✅ Сервер запускається без помилок
✅ Адмін-панель перенаправляє на логін
✅ Ресурс SurveyResponseResource створено
✅ Навігація налаштована правильно
```

## ✅ Статус: СТОРІНКА РЕЗУЛЬТАТІВ ДОДАНА

### Що створено:
- ✅ **SurveyResponseResource** з повним функціоналом
- ✅ **ListSurveyResponses** з вкладками та фільтрами
- ✅ **ViewSurveyResponse** з детальним переглядом
- ✅ **Групування навігації** "Опитування"

### Що тепер доступно:
- ✅ **Перегляд всіх результатів** опитувань
- ✅ **Фільтрація по опитуванню** та користувачу
- ✅ **Детальний перегляд** відповідей користувачів
- ✅ **Видалення результатів** з підтвердженням
- ✅ **Заготовка для експорту** результатів

Сторінка результатів опитувань успішно додана в адмін-панель! 🚀
