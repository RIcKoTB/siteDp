<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseRequirementResource\Pages;
use App\Models\CourseRequirement;
use App\Models\CourseTopic;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class CourseRequirementResource extends Resource
{
    protected static ?string $model = CourseRequirement::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Courses';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('topic_id')
                    ->label('Тема')
                    ->options(CourseTopic::all()->pluck('title', 'id'))
                    ->searchable()
                    ->required(),

                TextInput::make('requirement')
                    ->label('Вимога')
                    ->required()
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('topic.title')->label('Тема')->sortable()->searchable(),
                TextColumn::make('requirement')->label('Вимога')->sortable()->searchable(),
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
            'index'  => Pages\ListCourseRequirements::route('/'),
            'create' => Pages\CreateCourseRequirement::route('/create'),
            'edit'   => Pages\EditCourseRequirement::route('/{record}/edit'),
        ];
    }
}
