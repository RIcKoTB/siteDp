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
use Filament\Tables\Columns\TextColumn;

class PracticalCategoryResource extends Resource
{
    protected static ?string $model = PracticalCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Практична підготовка';
    protected static ?string $label = 'Категорії практичної підготовки';
    protected static ?string $pluralLabel = 'Категорії практичної підготовки';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->label('Назва категорії')
                ->required()
                ->maxLength(255),
            TextInput::make('slug')
                ->label('Слаг (URL)')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->sortable()->label('ID'),
            TextColumn::make('title')->label('Назва')->searchable(),
            TextColumn::make('slug')->label('Слаг'),
            TextColumn::make('created_at')->label('Створено')->dateTime(),
        ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
