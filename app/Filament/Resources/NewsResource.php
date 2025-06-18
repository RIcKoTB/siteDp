<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\{
    DatePicker,
    FileUpload,
    TextInput,
    Textarea,
    RichEditor,
    Repeater,
    Select
};
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\{
    ImageColumn,
    TextColumn
};

class NewsResource extends Resource
{
    protected static ?string $model = News::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Заголовок')
                    ->required()
                    ->maxLength(255),

                DatePicker::make('date')
                    ->label('Дата')
                    ->required(),

                FileUpload::make('img_path')
                    ->label('Головне зображення')
                    ->image()
                    ->directory('news')
                    ->required(),

                TextInput::make('url')
                    ->label('URL (slug або повний шлях)')
                    ->required()
                    ->maxLength(255),

                Select::make('category')
                    ->label('Категорія')
                    ->options([
                        'news' => '📰 Новини',
                        'events' => '🎉 Події',
                        'achievements' => '🏆 Досягнення',
                        'announcements' => '📢 Оголошення',
                    ])
                    ->default('news')
                    ->required(),

                RichEditor::make('content')
                    ->label('Основний контент')
                    ->required()
                    ->columnSpanFull(),

                Repeater::make('attachments')
                    ->label('Документи')
                    ->schema([
                        FileUpload::make('file')
                            ->label('Файл')
                            ->directory('news/files')
                            ->preserveFilenames()
                            ->downloadable()
                            ->acceptedFileTypes([
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'application/vnd.ms-excel',
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'text/plain',
                            ]),
                        TextInput::make('title')
                            ->label('Назва файлу')
                            ->required(),
                        Textarea::make('description')
                            ->label('Опис')
                            ->rows(2),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),

                Repeater::make('gallery')
                    ->label('Галерея зображень')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Зображення')
                            ->image()
                            ->directory('news/gallery')
                            ->required(),
                        TextInput::make('caption')
                            ->label('Підпис до зображення'),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Заголовок')->searchable()->sortable(),
                TextColumn::make('category')
                    ->label('Категорія')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'news' => 'gray',
                        'events' => 'success',
                        'achievements' => 'warning',
                        'announcements' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'news' => '📰 Новини',
                        'events' => '🎉 Події',
                        'achievements' => '🏆 Досягнення',
                        'announcements' => '📢 Оголошення',
                        default => $state,
                    })
                    ->sortable(),
                TextColumn::make('date')->label('Дата')->date()->sortable(),
                ImageColumn::make('img_path')->label('Зображення')->square(),
                TextColumn::make('views')->label('Перегляди')->sortable(),
                TextColumn::make('likes_count')->label('Лайки')->sortable()->getStateUsing(fn ($record) => $record->likes()->count()),
                TextColumn::make('comments_count')->label('Коментарі')->sortable()->getStateUsing(fn ($record) => $record->comments()->count()),
                TextColumn::make('url')->label('Посилання')->wrap(),
                TextColumn::make('created_at')->label('Створено')->dateTime(),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
