<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstructorResource\Pages;
use App\Models\Instructor;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class InstructorResource extends Resource
{
    protected static ?string $model = Instructor::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Program';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Ім’я')
                ->required()
                ->maxLength(100),

            TextInput::make('role')
                ->label('Посада')
                ->required()
                ->maxLength(100),

            FileUpload::make('img_path')
                ->label('Фото викладача')
                ->image()
                ->directory('instructors')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('img_path')
                ->label('Фото')
                ->circular(),

            TextColumn::make('name')
                ->label('Ім’я')
                ->sortable()
                ->searchable(),

            TextColumn::make('role')
                ->label('Посада')
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
            'index'  => Pages\ListInstructors::route('/'),
            'create' => Pages\CreateInstructor::route('/create'),
            'edit'   => Pages\EditInstructor::route('/{record}/edit'),
        ];
    }
}
