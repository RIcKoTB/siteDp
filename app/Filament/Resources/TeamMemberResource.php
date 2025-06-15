<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamMemberResource\Pages;
use App\Models\TeamMember;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'About';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Ім\'я')
                    ->required()
                    ->maxLength(100),

                TextInput::make('role')
                    ->label('Роль/Посада')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('img_path')
                    ->label('Фото')
                    ->image()
                    ->directory('team_members')
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
                    ->label('Ім\'я')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('role')
                    ->label('Роль')
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
            'index'  => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit'   => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}
