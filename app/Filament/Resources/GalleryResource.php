<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Filament\Resources\GalleryResource\RelationManagers;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Галерея';

    protected static ?string $modelLabel = 'Фото';

    protected static ?string $pluralModelLabel = 'Галерея';

    protected static ?string $navigationGroup = 'Контент';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основна інформація')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Назва фото')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label('Опис')
                            ->rows(3),
                        Forms\Components\Select::make('category')
                            ->label('Категорія')
                            ->options([
                                'general' => 'Загальні',
                                'classroom' => 'Аудиторії',
                                'students' => 'Студенти',
                                'events' => 'Події',
                                'graduation' => 'Випуски',
                                'laboratory' => 'Лабораторії',
                            ])
                            ->default('general')
                            ->required(),
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Зображення')
                            ->image()
                            ->directory('gallery')
                            ->required()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->helperText('Для завантаження декількох фото одночасно використовуйте кнопку "Масове завантаження"'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Налаштування відображення')
                    ->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Порядок сортування')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Активне')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Зображення')
                    ->disk('public')
                    ->size(80),
                Tables\Columns\TextColumn::make('title')
                    ->label('Назва')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category')
                    ->label('Категорія')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'general' => 'gray',
                        'classroom' => 'blue',
                        'students' => 'green',
                        'events' => 'yellow',
                        'graduation' => 'purple',
                        'laboratory' => 'orange',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Порядок')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активне')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Створено')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Категорія')
                    ->options([
                        'general' => 'Загальні',
                        'classroom' => 'Аудиторії',
                        'students' => 'Студенти',
                        'events' => 'Події',
                        'graduation' => 'Випуски',
                        'laboratory' => 'Лабораторії',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Активне'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('duplicate')
                    ->label('Дублювати')
                    ->icon('heroicon-o-document-duplicate')
                    ->color('gray')
                    ->action(function (Gallery $record) {
                        $newRecord = $record->replicate();
                        $newRecord->title = $record->title . ' (копія)';
                        $newRecord->sort_order = Gallery::max('sort_order') + 1;
                        $newRecord->save();

                        \Filament\Notifications\Notification::make()
                            ->title('Фото дубльовано')
                            ->body("Створено копію фото: {$newRecord->title}")
                            ->success()
                            ->send();
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Активувати вибрані')
                        ->icon('heroicon-o-eye')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each(fn ($record) => $record->update(['is_active' => true]));
                            \Filament\Notifications\Notification::make()
                                ->title('Фото активовано')
                                ->body('Вибрані фото були активовані')
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Деактивувати вибрані')
                        ->icon('heroicon-o-eye-slash')
                        ->color('warning')
                        ->action(function ($records) {
                            $records->each(fn ($record) => $record->update(['is_active' => false]));
                            \Filament\Notifications\Notification::make()
                                ->title('Фото деактивовано')
                                ->body('Вибрані фото були деактивовані')
                                ->warning()
                                ->send();
                        }),
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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'bulk-upload' => Pages\BulkUpload::route('/bulk-upload'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
