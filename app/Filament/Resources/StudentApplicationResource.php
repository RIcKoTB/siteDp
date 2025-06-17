<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentApplicationResource\Pages;
use App\Filament\Resources\StudentApplicationResource\RelationManagers;
use App\Models\StudentApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentApplicationResource extends Resource
{
    protected static ?string $model = StudentApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';
    protected static ?string $navigationGroup = 'Практична підготовка';
    protected static ?string $label = 'Заявка студента';
    protected static ?string $pluralLabel = 'Заявки студентів';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Інформація про заявку')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->label('Категорія')
                            ->relationship('category', 'title')
                            ->required()
                            ->disabled(),
                        Forms\Components\Select::make('topic_id')
                            ->label('Тема')
                            ->relationship('topic', 'title')
                            ->required()
                            ->disabled(),
                        Forms\Components\Select::make('status')
                            ->label('Статус')
                            ->options([
                                'pending' => 'Очікує розгляду',
                                'approved' => 'Схвалено',
                                'rejected' => 'Відхилено',
                            ])
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state === 'approved') {
                                    $set('approved_at', now());
                                } else {
                                    $set('approved_at', null);
                                }
                            }),
                        Forms\Components\DateTimePicker::make('approved_at')
                            ->label('Дата затвердження')
                            ->visible(fn ($get) => $get('status') === 'approved'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Інформація про студента')
                    ->schema([
                        Forms\Components\TextInput::make('student_name')
                            ->label('Ім\'я студента')
                            ->required()
                            ->maxLength(255)
                            ->disabled(),
                        Forms\Components\TextInput::make('student_email')
                            ->label('Email студента')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->disabled(),
                        Forms\Components\TextInput::make('student_phone')
                            ->label('Телефон студента')
                            ->tel()
                            ->maxLength(255)
                            ->disabled(),
                        Forms\Components\TextInput::make('student_group')
                            ->label('Група студента')
                            ->maxLength(255)
                            ->disabled(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Мотивація студента')
                    ->schema([
                        Forms\Components\Textarea::make('motivation')
                            ->label('Мотивація та досвід')
                            ->disabled()
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Примітки адміністратора')
                    ->schema([
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Примітки для студента')
                            ->placeholder('Додайте коментарі або рекомендації для студента...')
                            ->rows(3)
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
                Tables\Columns\TextColumn::make('topic.title')
                    ->label('Тема')
                    ->sortable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('student_name')
                    ->label('Студент')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('student_email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('student_group')
                    ->label('Група')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Статус')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Очікує',
                        'approved' => 'Схвалено',
                        'rejected' => 'Відхилено',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('approved_at')
                    ->label('Дата затвердження')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата подачі')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Статус')
                    ->options([
                        'pending' => 'Очікує розгляду',
                        'approved' => 'Схвалено',
                        'rejected' => 'Відхилено',
                    ]),
                Tables\Filters\SelectFilter::make('category')
                    ->label('Категорія')
                    ->relationship('category', 'title'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Розглянути'),
                Tables\Actions\Action::make('approve')
                    ->label('Схвалити')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'approved',
                            'approved_at' => now(),
                        ]);
                    })
                    ->visible(fn ($record) => $record->status === 'pending'),
                Tables\Actions\Action::make('reject')
                    ->label('Відхилити')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'rejected',
                            'approved_at' => null,
                        ]);
                    })
                    ->visible(fn ($record) => $record->status === 'pending'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListStudentApplications::route('/'),
            'create' => Pages\CreateStudentApplication::route('/create'),
            'edit' => Pages\EditStudentApplication::route('/{record}/edit'),
        ];
    }
}
