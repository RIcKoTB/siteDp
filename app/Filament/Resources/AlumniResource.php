<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlumniResource\Pages;
use App\Models\Alumni;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class AlumniResource extends Resource
{
    protected static ?string $model = Alumni::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Alumni';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Ім’я випускника')
                    ->required()
                    ->maxLength(100),

                TextInput::make('year')
                    ->label('Рік випуску')
                    ->required()
                    ->numeric(),

                TextInput::make('role')
                    ->label('Роль / Посада')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('img_path')
                    ->label('Фото випускника')
                    ->image()
                    ->directory('alumni')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('img_path')
                    ->label('Фото')
                    ->circular(),

                TextColumn::make('name')
                    ->label('Ім’я')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('year')
                    ->label('Рік')
                    ->sortable(),

                TextColumn::make('role')
                    ->label('Роль')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Створено')
                    ->dateTime(),
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
            'index'   => Pages\ListAlumnis::route('/'),
            'create'  => Pages\CreateAlumni::route('/create'),
            'edit'    => Pages\EditAlumni::route('/{record}/edit'),
        ];
    }
}
