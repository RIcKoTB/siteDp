<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PracticalCategoryResource\Pages;
use App\Models\PracticalCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;

class PracticalCategoryResource extends Resource
{
    protected static ?string $model = PracticalCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Практична підготовка';
    protected static ?string $label = 'Категорія';
    protected static ?string $pluralLabel = 'Категорії практичної підготовки';
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Основна інформація')
                ->schema([
                    TextInput::make('title')
                        ->label('Назва категорії')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                            if ($operation !== 'create') {
                                return;
                            }
                            $set('slug', \Illuminate\Support\Str::slug($state));
                        }),
                    TextInput::make('slug')
                        ->label('Слаг (URL)')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255)
                        ->helperText('Використовується в URL адресі сторінки'),
                ]),
            Section::make('Контент')
                ->schema([
                    RichEditor::make('content')
                        ->label('Опис категорії')
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'underline',
                            'bulletList',
                            'orderedList',
                            'link',
                            'h2',
                            'h3',
                        ])
                        ->columnSpanFull()
                        ->helperText('Детальний опис категорії практичної підготовки'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')
                ->sortable()
                ->label('ID'),
            TextColumn::make('title')
                ->label('Назва')
                ->searchable()
                ->sortable()
                ->weight('bold'),
            TextColumn::make('slug')
                ->label('Слаг')
                ->copyable()
                ->copyMessage('Слаг скопійовано!')
                ->badge()
                ->color('gray'),
            TextColumn::make('content')
                ->label('Контент')
                ->html()
                ->limit(50)
                ->tooltip(function (TextColumn $column): ?string {
                    $state = $column->getState();
                    if (strlen($state) <= 50) {
                        return null;
                    }
                    return strip_tags($state);
                }),
            TextColumn::make('created_at')
                ->label('Створено')
                ->dateTime('d.m.Y H:i')
                ->sortable()
                ->toggleable(),
        ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Переглянути сайт')
                    ->url(fn (PracticalCategory $record): string => route('practical.category', $record->slug))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-eye'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPracticalCategories::route('/'),
            'create' => Pages\CreatePracticalCategory::route('/create'),
            'edit' => Pages\EditPracticalCategory::route('/{record}/edit'),
        ];
    }
}
