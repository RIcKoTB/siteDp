<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PracticalTopicResource\Pages;
use App\Filament\Resources\PracticalTopicResource\RelationManagers;
use App\Models\PracticalTopic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ImportAction;
use App\Imports\TopicsImport;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PracticalTopicResource extends Resource
{
    protected static ?string $model = PracticalTopic::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Практична підготовка';
    protected static ?string $label = 'Теми';
    protected static ?string $pluralLabel = 'Теми';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основна інформація')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->label('Категорія')
                            ->relationship('category', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('title')
                            ->label('Назва теми')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Опис')
                            ->columnSpanFull(),
                        Forms\Components\Select::make('teacher_id')
                            ->label('Викладач')
                            ->relationship('teacherUser', 'name', fn($query) => $query->where('role', 'teacher'))
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label('Ім\'я викладача')
                                    ->required(),
                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required(),
                            ])
                            ->createOptionUsing(function (array $data) {
                                return \App\Models\User::create([
                                    'name' => $data['name'],
                                    'email' => $data['email'],
                                    'role' => 'teacher',
                                'password' => null, // Для викладачів створених через адмін панель
                                    'email_verified_at' => now(),
                                ])->id;
                            }),
                        Forms\Components\TextInput::make('hours')
                            ->label('Кількість годин')
                            ->numeric()
                            ->minValue(1),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Активна')
                            ->default(true),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Керівник')
                    ->schema([
                        Forms\Components\TextInput::make('supervisor_name')
                            ->label('Ім\'я керівника')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('supervisor_position')
                            ->label('Посада')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('supervisor_email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('supervisor_phone')
                            ->label('Телефон')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('supervisor_bio')
                            ->label('Біографія')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Вимоги')
                    ->schema([
                        Forms\Components\Textarea::make('requirements')
                            ->label('Вимоги до студента')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Етапи виконання')
                    ->schema([
                        Forms\Components\Repeater::make('stages')
                            ->label('Етапи')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Назва етапу')
                                    ->required(),
                                Forms\Components\Textarea::make('description')
                                    ->label('Опис'),
                                Forms\Components\DatePicker::make('start_date')
                                    ->label('Дата початку'),
                                Forms\Components\DatePicker::make('end_date')
                                    ->label('Дата завершення'),
                                Forms\Components\Select::make('status')
                                    ->label('Статус')
                                    ->options([
                                        'pending' => 'Очікує',
                                        'in_progress' => 'В процесі',
                                        'completed' => 'Завершено',
                                    ])
                                    ->default('pending'),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Корисні ресурси')
                    ->schema([
                        Forms\Components\Repeater::make('resources')
                            ->label('Ресурси')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Назва')
                                    ->required(),
                                Forms\Components\Textarea::make('description')
                                    ->label('Опис'),
                                Forms\Components\TextInput::make('url')
                                    ->label('Посилання')
                                    ->url(),
                                Forms\Components\Select::make('type')
                                    ->label('Тип')
                                    ->options([
                                        'link' => 'Посилання',
                                        'file' => 'Файл',
                                        'book' => 'Книга',
                                        'article' => 'Стаття',
                                        'video' => 'Відео',
                                    ])
                                    ->default('link'),
                                Forms\Components\Toggle::make('is_required')
                                    ->label('Обов\'язковий'),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Консультації')
                    ->schema([
                        Forms\Components\Repeater::make('consultations')
                            ->label('Консультації')
                            ->schema([
                                Forms\Components\TextInput::make('teacher')
                                    ->label('Викладач')
                                    ->required(),
                                Forms\Components\DateTimePicker::make('datetime')
                                    ->label('Дата та час')
                                    ->required(),
                                Forms\Components\TextInput::make('location')
                                    ->label('Місце')
                                    ->required(),
                                Forms\Components\Textarea::make('notes')
                                    ->label('Примітки'),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.title')
                    ->label('Категорія')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Назва теми')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('teacherUser.name')
                    ->label('Викладач')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hours')
                    ->label('Години')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активна')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Створено')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'title')
                    ->label('Категорія'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Детальна інформація'),
                Tables\Actions\EditAction::make()
                    ->label('Редагувати'),
                Tables\Actions\DeleteAction::make()
                    ->label('Видалити'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Видалити вибрані'),
                ]),
            ]);
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
            'index' => Pages\ListPracticalTopics::route('/'),
            'create' => Pages\CreatePracticalTopic::route('/create'),
            'view' => Pages\ViewPracticalTopic::route('/{record}'),
            'edit' => Pages\EditPracticalTopic::route('/{record}/edit'),
        ];
    }
}
