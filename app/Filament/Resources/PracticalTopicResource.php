<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PracticalTopicResource\Pages;
use App\Filament\Resources\PracticalTopicResource\RelationManagers;
use App\Models\PracticalTopic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PracticalTopicResource extends Resource
{
    protected static ?string $model = PracticalTopic::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'title')
                    ->required(),
                Forms\Components\TextInput::make('teacher_id')
                    ->numeric(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('teacher')
                    ->maxLength(255),
                Forms\Components\TextInput::make('supervisor_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('supervisor_position')
                    ->maxLength(255),
                Forms\Components\TextInput::make('supervisor_email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('supervisor_phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\Textarea::make('supervisor_bio')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('stages'),
                Forms\Components\TextInput::make('resources'),
                Forms\Components\Textarea::make('requirements')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('consultations'),
                Forms\Components\TextInput::make('hours')
                    ->numeric(),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('teacher_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('teacher')
                    ->searchable(),
                Tables\Columns\TextColumn::make('supervisor_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('supervisor_position')
                    ->searchable(),
                Tables\Columns\TextColumn::make('supervisor_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('supervisor_phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hours')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPracticalTopics::route('/'),
            'create' => Pages\CreatePracticalTopic::route('/create'),
            'edit' => Pages\EditPracticalTopic::route('/{record}/edit'),
        ];
    }
}
