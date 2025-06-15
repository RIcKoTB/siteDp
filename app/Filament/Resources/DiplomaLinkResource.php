<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiplomaLinkResource\Pages;
use App\Models\DiplomaLink;
use App\Models\DiplomaTopic;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class DiplomaLinkResource extends Resource
{
    protected static ?string $model = DiplomaLink::class;
    protected static ?string $navigationIcon = 'heroicon-o-link';
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

                TextInput::make('link_text')
                    ->label('Текст посилання')
                    ->required()
                    ->maxLength(100),

                TextInput::make('url')
                    ->label('URL')
                    ->url()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('topic.title')->label('Тема')->sortable()->searchable(),
                TextColumn::make('link_text')->label('Текст посилання')->sortable()->searchable(),
                TextColumn::make('url')->label('URL')->wrap(),
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
            'index'  => Pages\ListDiplomaLinks::route('/'),
            'create' => Pages\CreateDiplomaLink::route('/create'),
            'edit'   => Pages\EditDiplomaLink::route('/{record}/edit'),
        ];
    }
}
