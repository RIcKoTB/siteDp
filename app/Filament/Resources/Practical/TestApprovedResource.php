<?php

namespace App\Filament\Resources\Practical;

use App\Filament\Resources\Practical\TestApprovedResource\Pages;
use App\Filament\Resources\Practical\TestApprovedResource\RelationManagers;
use App\Models\Practical\TestApproved;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestApprovedResource extends Resource
{
    protected static ?string $model = TestApproved::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('topic_id')
                    ->label('Topic')
                    ->relationship('topic', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
            'index' => Pages\ListTestApproveds::route('/'),
            'create' => Pages\CreateTestApproved::route('/create'),
            'edit' => Pages\EditTestApproved::route('/{record}/edit'),
        ];
    }
}
