<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiplomaTopicResource\Pages;
use App\Models\DiplomaTopic;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class DiplomaTopicResource extends Resource
{
    protected static ?string $model = DiplomaTopic::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Diplomas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Назва теми')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Опис теми')
                    ->required(),

                TextInput::make('supervisor')
                    ->label('Керівник')
                    ->required()
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('title')->label('Назва')->searchable()->sortable(),
                TextColumn::make('supervisor')->label('Керівник')->sortable(),
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
            'index'  => Pages\ListDiplomaTopics::route('/'),
            'create' => Pages\CreateDiplomaTopic::route('/create'),
            'edit'   => Pages\EditDiplomaTopic::route('/{record}/edit'),
        ];
    }
}
