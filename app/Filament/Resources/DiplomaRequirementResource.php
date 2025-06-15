<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiplomaRequirementResource\Pages;
use App\Models\DiplomaRequirement;
use App\Models\DiplomaTopic;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class DiplomaRequirementResource extends Resource
{
    protected static ?string $model = DiplomaRequirement::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Diplomas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('topic_id')
                    ->label('Тема диплому')
                    ->options(DiplomaTopic::all()->pluck('title', 'id'))
                    ->searchable()
                    ->required(),

                TextInput::make('requirement')
                    ->label('Вимога')
                    ->required()
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('topic.title')->label('Тема')->sortable()->searchable(),
                TextColumn::make('requirement')->label('Вимога')->sortable()->searchable(),
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
            'index'  => Pages\ListDiplomaRequirements::route('/'),
            'create' => Pages\CreateDiplomaRequirement::route('/create'),
            'edit'   => Pages\EditDiplomaRequirement::route('/{record}/edit'),
        ];
    }
}
