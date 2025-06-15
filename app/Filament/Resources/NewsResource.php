<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\TrixEditor;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->label('Заголовок')->required()->maxLength(255),
                DatePicker::make('date')->label('Дата')->required(),
                FileUpload::make('img_path')->label('Головне зображення')->image()->directory('news')->required(),
                TextInput::make('url')->label('URL (slug або повний шлях)')->required()->maxLength(255),

                TrixEditor::make('content')
                    ->label('Основний контент')
                    ->columnSpanFull()
                    ->attachmentDisk('public')
                    ->attachmentDirectory('news/files')
                    ->attachFiles()
                    ->required(),

                Repeater::make('gallery')
                    ->label('Галерея зображень')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Зображення')
                            ->image()
                            ->directory('news/gallery'),
                        Textarea::make('caption')
                            ->label('Підпис до зображення')
                            ->rows(2)
                    ])
                    ->default([])
                    ->columnSpanFull(),

                TextInput::make('views')
                    ->label('Перегляди')
                    ->numeric()
                    ->default(0)
                    ->disabled(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('title')->label('Заголовок')->searchable()->sortable(),
                TextColumn::make('date')->label('Дата')->date()->sortable(),
                ImageColumn::make('img_path')->label('Зображення')->square(),
                TextColumn::make('views')->label('Перегляди')->sortable(),
                TextColumn::make('url')->label('Посилання')->wrap(),
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
            'index'  => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit'   => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
