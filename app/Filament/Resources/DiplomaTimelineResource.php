<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiplomaTimelineResource\Pages;
use App\Models\DiplomaTimeline;
use App\Models\DiplomaTopic;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class DiplomaTimelineResource extends Resource
{
    protected static ?string $model = DiplomaTimeline::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Diplomas';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('topic_id')
                ->label('Тема диплому')
                ->options(DiplomaTopic::all()->pluck('title','id'))
                ->searchable()
                ->required(),

            TextInput::make('step_order')
                ->label('Порядок етапу')
                ->numeric()
                ->required(),

            DatePicker::make('date')
                ->label('Дата')
                ->required(),

            TextInput::make('description')
                ->label('Опис етапу')
                ->required()
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->label('ID')->sortable(),
            TextColumn::make('topic.title')->label('Тема')->sortable()->searchable(),
            TextColumn::make('step_order')->label('Порядок')->sortable(),
            TextColumn::make('date')->label('Дата')->date()->sortable(),
            TextColumn::make('description')->label('Опис')->wrap()->sortable(),
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
            'index'  => Pages\ListDiplomaTimelines::route('/'),
            'create' => Pages\CreateDiplomaTimeline::route('/create'),
            'edit'   => Pages\EditDiplomaTimeline::route('/{record}/edit'),
        ];
    }
}
