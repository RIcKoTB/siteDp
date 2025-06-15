<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SurveyResponseResource\Pages;
use App\Models\SurveyResponse;
use App\Models\SurveyCategory;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class SurveyResponseResource extends Resource
{
    protected static ?string $model = SurveyResponse::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Survey';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('category_id')
                ->label('Категорія опитування')
                ->options(SurveyCategory::all()->pluck('title', 'id'))
                ->searchable()
                ->required(),

            TextInput::make('rating')
                ->label('Рейтинг')
                ->numeric()
                ->required()
                ->minValue(1)
                ->maxValue(5),

            Textarea::make('comment')
                ->label('Коментар')
                ->rows(3),

            DateTimePicker::make('submitted_at')
                ->label('Час надсилання')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->label('ID')->sortable(),
            TextColumn::make('category.title')->label('Категорія')->sortable()->searchable(),
            TextColumn::make('rating')->label('Рейтинг')->sortable(),
            TextColumn::make('comment')->label('Коментар')->limit(50)->wrap(),
            TextColumn::make('submitted_at')->label('Надіслано')->dateTime()->sortable(),
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
            'index'  => Pages\ListSurveyResponses::route('/'),
            'create' => Pages\CreateSurveyResponse::route('/create'),
            'edit'   => Pages\EditSurveyResponse::route('/{record}/edit'),
        ];
    }
}
