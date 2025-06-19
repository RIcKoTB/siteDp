<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoryEventResource\Pages;
use App\Models\HistoryEvent;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class HistoryEventResource extends Resource
{
    protected static ?string $model = HistoryEvent::class;
    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Про нас';

    protected static ?string $navigationLabel = 'Наша історія';

    protected static ?string $pluralModelLabel = 'Наша історія';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('event_year')
                    ->label('Рік події')
                    ->numeric()
                    ->required()
                    ->minValue(1900)
                    ->maxValue((int) date('Y')),

                TextInput::make('description')
                    ->label('Опис')
                    ->required()
                    ->maxLength(255),

                TextInput::make('sort_order')
                    ->label('Порядок сортування')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('event_year')->label('Рік')->sortable(),
                TextColumn::make('description')->label('Опис')->wrap()->sortable(),
                TextColumn::make('sort_order')->label('Порядок')->sortable(),
                TextColumn::make('created_at')->label('Створено')->dateTime(),
                TextColumn::make('updated_at')->label('Оновлено')->dateTime(),
            ])
            ->defaultSort('sort_order')
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
            'index' => Pages\ListHistoryEvents::route('/'),
            'create' => Pages\CreateHistoryEvent::route('/create'),
            'edit' => Pages\EditHistoryEvent::route('/{record}/edit'),
        ];
    }
}
