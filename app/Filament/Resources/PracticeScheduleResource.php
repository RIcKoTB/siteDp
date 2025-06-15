<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PracticeScheduleResource\Pages;
use App\Models\PracticeSchedule;
use App\Models\PracticeModule;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class PracticeScheduleResource extends Resource
{
    protected static ?string $model = PracticeSchedule::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Practice';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('module_id')
                    ->label('Модуль')
                    ->options(PracticeModule::all()->pluck('title', 'id'))
                    ->searchable()
                    ->required(),

                DatePicker::make('date')
                    ->label('Дата')
                    ->required(),

                TimePicker::make('start_time')
                    ->label('Початок')
                    ->required(),

                TimePicker::make('end_time')
                    ->label('Кінець')
                    ->required(),

                TextInput::make('room')
                    ->label('Аудиторія')
                    ->required()
                    ->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('module.title')->label('Модуль')->sortable()->searchable(),
                TextColumn::make('date')->label('Дата')->date()->sortable(),
                TextColumn::make('start_time')->label('Початок')->time()->sortable(),
                TextColumn::make('end_time')->label('Кінець')->time()->sortable(),
                TextColumn::make('room')->label('Аудиторія')->sortable(),
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
            'index'  => Pages\ListPracticeSchedules::route('/'),
            'create' => Pages\CreatePracticeSchedule::route('/create'),
            'edit'   => Pages\EditPracticeSchedule::route('/{record}/edit'),
        ];
    }
}
