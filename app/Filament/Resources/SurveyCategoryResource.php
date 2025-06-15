<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SurveyCategoryResource\Pages;
use App\Models\SurveyCategory;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class SurveyCategoryResource extends Resource
{
    protected static ?string $model = SurveyCategory::class;
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Survey';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->maxLength(50)
                ->unique(ignoreRecord: true),

            TextInput::make('title')
                ->label('Назва категорії')
                ->required()
                ->maxLength(100),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('slug')->label('Slug')->searchable()->sortable(),
                TextColumn::make('title')->label('Назва')->searchable()->sortable(),
                TextColumn::make('created_at')->label('Створено')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSurveyCategories::route('/'),
            'create' => Pages\CreateSurveyCategory::route('/create'),
            'edit'   => Pages\EditSurveyCategory::route('/{record}/edit'),
        ];
    }
}
