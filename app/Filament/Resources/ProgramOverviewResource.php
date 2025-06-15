<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramOverviewResource\Pages;
use App\Models\ProgramOverview;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class ProgramOverviewResource extends Resource
{
    protected static ?string $model = ProgramOverview::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Program';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Заголовок')
                    ->required()
                    ->maxLength(100),

                TextInput::make('value')
                    ->label('Значення')
                    ->required()
                    ->maxLength(100),

                TextInput::make('icon')
                    ->label('Іконка (CSS-клас)')
                    ->required()
                    ->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('title')->label('Заголовок')->searchable()->sortable(),
                TextColumn::make('value')->label('Значення')->sortable(),
                TextColumn::make('icon')->label('Іконка')->sortable(),
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
            'index'   => Pages\ListProgramOverviews::route('/'),
            'create'  => Pages\CreateProgramOverview::route('/create'),
            'edit'    => Pages\EditProgramOverview::route('/{record}/edit'),
        ];
    }
}
