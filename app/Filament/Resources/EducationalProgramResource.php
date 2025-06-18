<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationalProgramResource\Pages;
use App\Models\EducationalProgram;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EducationalProgramResource extends Resource
{
    protected static ?string $model = EducationalProgram::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationLabel = 'Освітньо-професійні програми';
    
    protected static ?string $modelLabel = 'освітньо-професійна програма';
    
    protected static ?string $pluralModelLabel = 'освітньо-професійні програми';
    
    protected static ?string $navigationGroup = 'ОПП та Опитування';

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
                                    ->label('Назва програми')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan(2),
                                
                                Forms\Components\TextInput::make('code')
                                    ->label('Код програми')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->placeholder('123 Комп\'ютерна інженерія'),
                                
                                Forms\Components\TextInput::make('qualification')
                                    ->label('Кваліфікація')
                                    ->placeholder('Бакалавр з комп\'ютерної інженерії')
                                    ->maxLength(255),
                                
                                Forms\Components\Textarea::make('description')
                                    ->label('Опис програми')
                                    ->required()
                                    ->rows(4)
                                    ->columnSpanFull(),
                                
                                Forms\Components\Textarea::make('objectives')
                                    ->label('Цілі програми')
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ])->columns(2),
                        
                        // Навчальні характеристики
                        Forms\Components\Tabs\Tab::make('Навчальні характеристики')
                            ->schema([
                                Forms\Components\TextInput::make('duration_years')
                                    ->label('Тривалість навчання (років)')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(6)
                                    ->default(4),
                                
                                Forms\Components\TextInput::make('credits_total')
                                    ->label('Загальна кількість кредитів')
                                    ->required()
                                    ->numeric()
                                    ->minValue(180)
                                    ->maxValue(300)
                                    ->default(240),
                                
                                Forms\Components\Textarea::make('admission_requirements')
                                    ->label('Вимоги до вступу')
                                    ->rows(4)
                                    ->columnSpanFull()
                                    ->placeholder('Повна загальна середня освіта, ЗНО з математики та української мови...'),
                                
                                Forms\Components\Textarea::make('career_prospects')
                                    ->label('Перспективи кар\'єри')
                                    ->rows(4)
                                    ->columnSpanFull()
                                    ->placeholder('Програміст, системний адміністратор, аналітик...'),
                            ])->columns(2),
                        
                        // Компетентності
                        Forms\Components\Tabs\Tab::make('Компетентності')
                            ->schema([
                                Forms\Components\Repeater::make('competencies')
                                    ->label('Програмні компетентності')
                                    ->schema([
                                        Forms\Components\TextInput::make('code')
                                            ->label('Код')
                                            ->placeholder('ПК-1')
                                            ->required(),
                                        
                                        Forms\Components\Textarea::make('description')
                                            ->label('Опис компетентності')
                                            ->required()
                                            ->rows(3)
                                            ->columnSpan(2),
                                    ])
                                    ->columns(3)
                                    ->columnSpanFull()
                                    ->addActionLabel('Додати компетентність')
                                    ->reorderable()
                                    ->collapsible(),
                            ]),
                        
                        // Результати навчання
                        Forms\Components\Tabs\Tab::make('Результати навчання')
                            ->schema([
                                Forms\Components\Repeater::make('learning_outcomes')
                                    ->label('Програмні результати навчання')
                                    ->schema([
                                        Forms\Components\TextInput::make('code')
                                            ->label('Код')
                                            ->placeholder('ПРН-1')
                                            ->required(),
                                        
                                        Forms\Components\Textarea::make('description')
                                            ->label('Опис результату навчання')
                                            ->required()
                                            ->rows(3)
                                            ->columnSpan(2),
                                    ])
                                    ->columns(3)
                                    ->columnSpanFull()
                                    ->addActionLabel('Додати результат навчання')
                                    ->reorderable()
                                    ->collapsible(),
                            ]),
                        
                        // Навчальний план
                        Forms\Components\Tabs\Tab::make('Навчальний план')
                            ->schema([
                                Forms\Components\Repeater::make('curriculum')
                                    ->label('Структура навчального плану')
                                    ->schema([
                                        Forms\Components\TextInput::make('semester')
                                            ->label('Семестр')
                                            ->numeric()
                                            ->required(),
                                        
                                        Forms\Components\TextInput::make('subject')
                                            ->label('Навчальна дисципліна')
                                            ->required()
                                            ->columnSpan(2),
                                        
                                        Forms\Components\TextInput::make('credits')
                                            ->label('Кредити')
                                            ->numeric()
                                            ->required(),
                                        
                                        Forms\Components\Select::make('type')
                                            ->label('Тип')
                                            ->options([
                                                'Обов\'язкова' => 'Обов\'язкова',
                                                'Вибіркова' => 'Вибіркова',
                                                'Практика' => 'Практика',
                                                'Атестація' => 'Атестація',
                                            ])
                                            ->required(),
                                    ])
                                    ->columns(5)
                                    ->columnSpanFull()
                                    ->addActionLabel('Додати дисципліну')
                                    ->reorderable()
                                    ->collapsible(),
                            ]),
                        
                        // Налаштування
                        Forms\Components\Tabs\Tab::make('Налаштування')
                            ->schema([
                                Forms\Components\FileUpload::make('image_url')
                                    ->label('Зображення програми')
                                    ->image()
                                    ->directory('educational-programs')
                                    ->columnSpanFull(),
                                
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Активна програма')
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
                    ->label('Назва програми')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                
                Tables\Columns\TextColumn::make('qualification')
                    ->label('Кваліфікація')
                    ->limit(30)
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('duration_years')
                    ->label('Тривалість')
                    ->alignCenter()
                    ->badge()
                    ->color('info')
                    ->formatStateUsing(fn ($state) => $state . ' р.'),
                
                Tables\Columns\TextColumn::make('credits_total')
                    ->label('Кредити')
                    ->alignCenter()
                    ->badge()
                    ->color('success'),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активна')
                    ->boolean()
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Створено')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Статус')
                    ->placeholder('Всі програми')
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
            'index' => Pages\ListEducationalPrograms::route('/'),
            'create' => Pages\CreateEducationalProgram::route('/create'),
            'edit' => Pages\EditEducationalProgram::route('/{record}/edit'),
        ];
    }
}
