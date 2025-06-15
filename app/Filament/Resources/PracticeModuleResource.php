<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PracticeModuleResource\Pages;
use App\Models\PracticeModule;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;

class PracticeModuleResource extends Resource
{
    protected static ?string $model = PracticeModule::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Practice';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('module_type')
                    ->label('Тип модуля')
                    ->options([
                        'lab' => 'Лабораторна',
                        'project' => 'Проєкт',
                        'internship' => 'Стажування',
                    ])
                    ->required(),

                TextInput::make('title')
                    ->label('Заголовок')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Опис')
                    ->required(),

                TextInput::make('resource_url')
                    ->label('URL ресурсу')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                BadgeColumn::make('module_type')
                    ->label('Тип')
                    ->colors([
                        'primary' => 'lab',
                        'success' => 'project',
                        'warning' => 'internship',
                    ]),

                TextColumn::make('title')
                    ->label('Заголовок')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('resource_url')
                    ->label('Ресурс')
                    ->url()
                    ->openUrlInNewTab(),

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
            'index'  => Pages\ListPracticeModules::route('/'),
            'create' => Pages\CreatePracticeModule::route('/create'),
            'edit'   => Pages\EditPracticeModule::route('/{record}/edit'),
        ];
    }
}
