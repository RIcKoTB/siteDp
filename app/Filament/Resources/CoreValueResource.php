<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoreValueResource\Pages;
use App\Models\CoreValue;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class CoreValueResource extends Resource
{
    protected static ?string $model = CoreValue::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'About';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Заголовок цінності')
                    ->required()
                    ->maxLength(100),

                TextInput::make('description')
                    ->label('Опис')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('img_path')
                    ->label('Іконка / Зображення')
                    ->image()
                    ->directory('core_values')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('img_path')
                    ->label('Іконка')
                    ->square(),

                TextColumn::make('title')
                    ->label('Заголовок')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('description')
                    ->label('Опис')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Створено')
                    ->dateTime(),

                TextColumn::make('updated_at')
                    ->label('Оновлено')
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
            'index'  => Pages\ListCoreValues::route('/'),
            'create' => Pages\CreateCoreValue::route('/create'),
            'edit'   => Pages\EditCoreValue::route('/{record}/edit'),
        ];
    }
}
