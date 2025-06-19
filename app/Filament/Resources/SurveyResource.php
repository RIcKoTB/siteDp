<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SurveyResource\Pages;
use App\Models\Survey;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SurveyResource extends Resource
{
    protected static ?string $model = Survey::class;

    protected static ?string $navigationIcon = "heroicon-o-clipboard-document-check";

    protected static ?string $navigationLabel = "Опитування";
    
    protected static ?string $navigationGroup = "Опитування";
    
    protected static ?int $navigationSort = 1;
    
    
    protected static ?string $modelLabel = 'опитування';
    
    protected static ?string $pluralModelLabel = 'опитування';
    

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
                                    ->label('Назва опитування')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                                
                                Forms\Components\Textarea::make('description')
                                    ->label('Опис опитування')
                                    ->rows(3)
                                    ->columnSpanFull()
                                    ->placeholder('Коротко опишіть мету та зміст опитування'),
                                
                                Forms\Components\Select::make('target_audience')
                                    ->label('Цільова аудиторія')
                                    ->options([
                                        'Студенти' => 'Студенти',
                                        'Викладачі' => 'Викладачі',
                                        'Випускники' => 'Випускники',
                                        'Роботодавці' => 'Роботодавці',
                                        'Всі' => 'Всі',
                                    ])
                                    ->placeholder('Оберіть цільову аудиторію'),
                                
                                Forms\Components\Toggle::make('is_anonymous')
                                    ->label('Анонімне опитування')
                                    ->default(true)
                                    ->helperText('Чи збирати персональні дані респондентів'),
                            ])->columns(2),
                        
                        // Питання
                        Forms\Components\Tabs\Tab::make('Питання')
                            ->schema([
                                Forms\Components\Repeater::make('questions')
                                    ->label('Питання опитування')
                                    ->schema([
                                        Forms\Components\TextInput::make('question')
                                            ->label('Текст питання')
                                            ->required()
                                            ->columnSpan(2),
                                        
                                        Forms\Components\Select::make('type')
                                            ->label('Тип питання')
                                            ->options([
                                                'text' => 'Текстове поле',
                                                'textarea' => 'Багаторядкове поле',
                                                'radio' => 'Один варіант (радіо)',
                                                'checkbox' => 'Кілька варіантів (чекбокс)',
                                                'select' => 'Випадаючий список',
                                                'rating' => 'Оцінка (1-5)',
                                                'yes_no' => 'Так/Ні',
                                            ])
                                            ->required()
                                            ->reactive(),
                                        
                                        Forms\Components\Toggle::make('required')
                                            ->label('Обов\'язкове')
                                            ->default(false),
                                        
                                        Forms\Components\Repeater::make('options')
                                            ->label('Варіанти відповідей')
                                            ->simple(
                                                Forms\Components\TextInput::make('option')
                                                    ->label('Варіант')
                                                    ->required()
                                            )
                                            ->visible(fn ($get) => in_array($get('type'), ['radio', 'checkbox', 'select']))
                                            ->columnSpanFull()
                                            ->addActionLabel('Додати варіант'),
                                    ])
                                    ->columns(3)
                                    ->columnSpanFull()
                                    ->addActionLabel('Додати питання')
                                    ->reorderable()
                                    ->collapsible(),
                            ]),
                        
                        // Налаштування
                        Forms\Components\Tabs\Tab::make('Налаштування')
                            ->schema([
                                Forms\Components\DateTimePicker::make('start_date')
                                    ->label('Дата початку')
                                    ->helperText('Залиште порожнім для негайного початку'),
                                
                                Forms\Components\DateTimePicker::make('end_date')
                                    ->label('Дата завершення')
                                    ->helperText('Залиште порожнім для необмеженого терміну'),
                                
                                Forms\Components\Textarea::make('thank_you_message')
                                    ->label('Повідомлення подяки')
                                    ->rows(3)
                                    ->columnSpanFull()
                                    ->placeholder('Дякуємо за участь в опитуванні!')
                                    ->default('Дякуємо за участь в опитуванні! Ваші відповіді допоможуть нам покращити якість освіти.'),
                                
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Активне опитування')
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
                Tables\Columns\TextColumn::make('title')
                    ->label('Назва опитування')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                
                Tables\Columns\TextColumn::make('target_audience')
                    ->label('Аудиторія')
                    ->badge()
                    ->color('info'),
                
                Tables\Columns\TextColumn::make('status')
                    ->label('Статус')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Активне' => 'success',
                        'Заплановане' => 'warning',
                        'Завершене' => 'gray',
                        'Неактивне' => 'danger',
                        default => 'gray',
                    }),
                
                Tables\Columns\IconColumn::make('is_anonymous')
                    ->label('Анонімне')
                    ->boolean()
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Початок')
                    ->dateTime('d.m.Y H:i')
                    ->placeholder('Негайно')
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Завершення')
                    ->dateTime('d.m.Y H:i')
                    ->placeholder('Необмежено')
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('questions')
                    ->label('Питань')
                    ->alignCenter()
                    ->formatStateUsing(fn ($state) => is_array($state) ? count($state) : 0),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Створено')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('target_audience')
                    ->label('Аудиторія')
                    ->options([
                        'Студенти' => 'Студенти',
                        'Викладачі' => 'Викладачі',
                        'Випускники' => 'Випускники',
                        'Роботодавці' => 'Роботодавці',
                        'Всі' => 'Всі',
                    ]),
                
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Статус')
                    ->placeholder('Всі опитування')
                    ->trueLabel('Тільки активні')
                    ->falseLabel('Тільки неактивні'),
                
                Tables\Filters\TernaryFilter::make('is_anonymous')
                    ->label('Тип')
                    ->placeholder('Всі типи')
                    ->trueLabel('Тільки анонімні')
                    ->falseLabel('Тільки іменні'),
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
            'index' => Pages\ListSurveys::route('/'),
            'create' => Pages\CreateSurvey::route('/create'),
            'edit' => Pages\EditSurvey::route('/{record}/edit'),
        ];
    }
}
