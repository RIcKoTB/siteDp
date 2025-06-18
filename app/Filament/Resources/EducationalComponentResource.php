<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationalComponentResource\Pages;
use App\Models\EducationalComponent;
use App\Models\EducationalCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EducationalComponentResource extends Resource
{
    protected static ?string $model = EducationalComponent::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    
    protected static ?string $navigationLabel = 'Освітні компоненти';
    
    protected static ?string $modelLabel = 'освітній компонент';
    
    protected static ?string $pluralModelLabel = 'освітні компоненти';
    
    protected static ?string $navigationGroup = 'Освітні компоненти';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        // Основна інформація
                        Forms\Components\Tabs\Tab::make('Основна інформація')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Назва предмету')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan(2),
                                
                                Forms\Components\TextInput::make('code')
                                    ->label('Код предмету')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->placeholder('ІТ-101'),
                                
                                Forms\Components\Select::make('category')
                                    ->label('Категорія')
                                    ->required()
                                    ->options(
                                        EducationalCategory::active()->ordered()->pluck('name', 'slug')
                                    )
                                    ->searchable(),
                                
                                Forms\Components\Textarea::make('description')
                                    ->label('Опис предмету')
                                    ->required()
                                    ->rows(4)
                                    ->columnSpanFull(),
                                
                                Forms\Components\Textarea::make('objectives')
                                    ->label('Цілі та завдання')
                                    ->required()
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ])->columns(2),
                        
                        // Навчальне навантаження
                        Forms\Components\Tabs\Tab::make('Навчальне навантаження')
                            ->schema([
                                Forms\Components\TextInput::make('credits')
                                    ->label('Кількість кредитів')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(10),
                                
                                Forms\Components\TextInput::make('semester')
                                    ->label('Семестр вивчення')
                                    ->required()
                                    ->placeholder('1, 2, 3...'),
                                
                                Forms\Components\TextInput::make('hours_total')
                                    ->label('Загальна кількість годин')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1),
                                
                                Forms\Components\TextInput::make('hours_lectures')
                                    ->label('Години лекцій')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0)
                                    ->default(0),
                                
                                Forms\Components\TextInput::make('hours_practical')
                                    ->label('Години практичних')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0)
                                    ->default(0),
                                
                                Forms\Components\TextInput::make('hours_laboratory')
                                    ->label('Години лабораторних')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0)
                                    ->default(0),
                                
                                Forms\Components\TextInput::make('hours_independent')
                                    ->label('Години самостійної роботи')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0)
                                    ->default(0),
                            ])->columns(2),
                        
                        // Зміст та результати
                        Forms\Components\Tabs\Tab::make('Зміст та результати')
                            ->schema([
                                Forms\Components\RichEditor::make('content')
                                    ->label('Зміст дисципліни')
                                    ->columnSpanFull()
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                        'bulletList',
                                        'orderedList',
                                        'h2',
                                        'h3',
                                        'link',
                                    ]),
                                
                                Forms\Components\Repeater::make('learning_outcomes')
                                    ->label('Результати навчання')
                                    ->simple(
                                        Forms\Components\Textarea::make('outcome')
                                            ->label('Результат навчання')
                                            ->required()
                                            ->rows(2)
                                    )
                                    ->columnSpanFull()
                                    ->addActionLabel('Додати результат навчання'),
                                
                                Forms\Components\Repeater::make('assessment_methods')
                                    ->label('Методи оцінювання')
                                    ->simple(
                                        Forms\Components\TextInput::make('method')
                                            ->label('Метод оцінювання')
                                            ->required()
                                            ->placeholder('Екзамен (50%)')
                                    )
                                    ->columnSpanFull()
                                    ->addActionLabel('Додати метод оцінювання'),
                            ]),
                        
                        // Викладач та розклад
                        Forms\Components\Tabs\Tab::make('Викладач та розклад')
                            ->schema([
                                Forms\Components\Section::make('Інформація про викладача')
                                    ->schema([
                                        Forms\Components\TextInput::make('teacher_name')
                                            ->label('Ім\'я викладача')
                                            ->maxLength(255),
                                        
                                        Forms\Components\TextInput::make('teacher_email')
                                            ->label('Email викладача')
                                            ->email()
                                            ->maxLength(255),
                                    ])->columns(2),
                                
                                Forms\Components\Repeater::make('schedule')
                                    ->label('Розклад занять')
                                    ->schema([
                                        Forms\Components\Select::make('day')
                                            ->label('День тижня')
                                            ->options([
                                                'Понеділок' => 'Понеділок',
                                                'Вівторок' => 'Вівторок',
                                                'Середа' => 'Середа',
                                                'Четвер' => 'Четвер',
                                                'П\'ятниця' => 'П\'ятниця',
                                                'Субота' => 'Субота',
                                            ])
                                            ->required(),
                                        
                                        Forms\Components\TextInput::make('time')
                                            ->label('Час')
                                            ->placeholder('08:30-10:05')
                                            ->required(),
                                        
                                        Forms\Components\Select::make('type')
                                            ->label('Тип заняття')
                                            ->options([
                                                'Лекція' => 'Лекція',
                                                'Практична' => 'Практична',
                                                'Лабораторна' => 'Лабораторна',
                                                'Семінар' => 'Семінар',
                                            ])
                                            ->required(),
                                        
                                        Forms\Components\TextInput::make('room')
                                            ->label('Аудиторія')
                                            ->placeholder('201')
                                            ->required(),
                                    ])
                                    ->columns(4)
                                    ->columnSpanFull()
                                    ->addActionLabel('Додати заняття'),
                            ]),
                        
                        // Література
                        Forms\Components\Tabs\Tab::make('Література')
                            ->schema([
                                Forms\Components\Repeater::make('literature')
                                    ->label('Список літератури')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Назва')
                                            ->required()
                                            ->columnSpan(2),
                                        
                                        Forms\Components\TextInput::make('author')
                                            ->label('Автор')
                                            ->required(),
                                        
                                        Forms\Components\TextInput::make('year')
                                            ->label('Рік видання')
                                            ->numeric()
                                            ->minValue(1900)
                                            ->maxValue(date('Y')),
                                        
                                        Forms\Components\Select::make('type')
                                            ->label('Тип літератури')
                                            ->options([
                                                'Основна' => 'Основна',
                                                'Додаткова' => 'Додаткова',
                                                'Методична' => 'Методична',
                                            ])
                                            ->required(),
                                        
                                        Forms\Components\TextInput::make('publisher')
                                            ->label('Видавництво')
                                            ->placeholder('Назва видавництва'),
                                    ])
                                    ->columns(3)
                                    ->columnSpanFull()
                                    ->addActionLabel('Додати книгу')
                                    ->reorderable()
                                    ->collapsible(),
                            ]),
                        
                        // Методичні матеріали
                        Forms\Components\Tabs\Tab::make('Методичні матеріали')
                            ->schema([
                                Forms\Components\Repeater::make('methodical_materials')
                                    ->label('Методичні матеріали та посібники')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Назва матеріалу')
                                            ->required()
                                            ->placeholder('Методичні вказівки до лабораторних робіт')
                                            ->columnSpan(2),
                                        
                                        Forms\Components\Textarea::make('description')
                                            ->label('Опис')
                                            ->placeholder('Короткий опис змісту методичного матеріалу')
                                            ->rows(2)
                                            ->columnSpan(2),
                                        
                                        Forms\Components\TextInput::make('url')
                                            ->label('Посилання')
                                            ->url()
                                            ->placeholder('https://example.com/material.pdf')
                                            ->helperText('Посилання на файл або веб-сторінку'),
                                        
                                        Forms\Components\Select::make('type')
                                            ->label('Тип матеріалу')
                                            ->options([
                                                'Методичні вказівки' => 'Методичні вказівки',
                                                'Лабораторний практикум' => 'Лабораторний практикум',
                                                'Курс лекцій' => 'Курс лекцій',
                                                'Практикум' => 'Практикум',
                                                'Збірник завдань' => 'Збірник завдань',
                                                'Презентації' => 'Презентації',
                                                'Відеоматеріали' => 'Відеоматеріали',
                                                'Інше' => 'Інше',
                                            ])
                                            ->required(),
                                        
                                        Forms\Components\TextInput::make('author')
                                            ->label('Автор/Викладач')
                                            ->placeholder('Прізвище І.О.'),
                                        
                                        Forms\Components\TextInput::make('year')
                                            ->label('Рік створення')
                                            ->numeric()
                                            ->minValue(2000)
                                            ->maxValue(date('Y'))
                                            ->default(date('Y')),
                                    ])
                                    ->columns(2)
                                    ->columnSpanFull()
                                    ->addActionLabel('Додати методичний матеріал')
                                    ->reorderable()
                                    ->collapsible(),
                            ]),
                        
                        // Налаштування
                        Forms\Components\Tabs\Tab::make('Налаштування')
                            ->schema([
                                Forms\Components\FileUpload::make('image_url')
                                    ->label('Зображення предмету')
                                    ->image()
                                    ->directory('educational-components')
                                    ->columnSpanFull(),
                                
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Активний предмет')
                                    ->default(true),
                                
                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Порядок сортування')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Чим менше число, тим вище в списку'),
                            ])->columns(2),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Код')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('primary'),
                
                Tables\Columns\TextColumn::make('title')
                    ->label('Назва предмету')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                
                Tables\Columns\TextColumn::make('categoryModel.name')
                    ->label('Категорія')
                    ->badge()
                    ->color(fn ($record) => $record->categoryModel?->color ?? 'gray'),
                
                Tables\Columns\TextColumn::make('credits')
                    ->label('Кредити')
                    ->alignCenter()
                    ->badge()
                    ->color('success'),
                
                Tables\Columns\TextColumn::make('semester')
                    ->label('Семестр')
                    ->alignCenter()
                    ->badge()
                    ->color('info'),
                
                Tables\Columns\TextColumn::make('hours_total')
                    ->label('Годин')
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('teacher_name')
                    ->label('Викладач')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активний')
                    ->boolean()
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Створено')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Категорія')
                    ->options(
                        EducationalCategory::active()->ordered()->pluck('name', 'slug')
                    ),
                
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Статус')
                    ->placeholder('Всі предмети')
                    ->trueLabel('Тільки активні')
                    ->falseLabel('Тільки неактивні'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEducationalComponents::route('/'),
            'create' => Pages\CreateEducationalComponent::route('/create'),
            'edit' => Pages\EditEducationalComponent::route('/{record}/edit'),
        ];
    }
}
