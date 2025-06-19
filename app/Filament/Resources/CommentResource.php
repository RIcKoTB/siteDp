<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Новини';

    protected static ?string $navigationLabel = 'Коментарі';

    protected static ?string $pluralModelLabel = 'Коментарі';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('news_id')
                    ->label('Новина')
                    ->relationship(name: 'news', titleAttribute: 'title')
                    ->searchable()
                    ->preload() // <- дуже важливо
                    ->required(),


                Select::make('parent_id')
                    ->label('Батьківський коментар')
                    ->relationship('parent', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->preview)
                    ->searchable()
                    ->preload()
                    ->nullable(),

                TextInput::make('author_name')
                    ->label('Імʼя автора')
                    ->required()
                    ->maxLength(100),

                Textarea::make('content')
                    ->label('Коментар')
                    ->required()
                    ->maxLength(1000),

                TextInput::make('views')
                    ->label('Перегляди')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('news.title')->label('Новина')->searchable(),
                TextColumn::make('author_name')->label('Автор')->sortable()->searchable(),
                TextColumn::make('parent.preview')
                    ->label('Батьківський коментар')
                    ->default('—')
                    ->toggleable()
                    ->limit(50),
                TextColumn::make('views')->label('Перегляди')->sortable(),
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
