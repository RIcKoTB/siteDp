<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactSettingResource\Pages;
use App\Filament\Resources\ContactSettingResource\RelationManagers;
use App\Models\ContactSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactSettingResource extends Resource
{
    protected static ?string $model = ContactSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationLabel = 'Контактні дані';

    protected static ?string $modelLabel = 'Налаштування';

    protected static ?string $pluralModelLabel = 'Контактні дані';

    protected static ?string $navigationGroup = 'Налаштування';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основна інформація')
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->label('Ключ')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->helperText('Унікальний ідентифікатор налаштування'),
                        Forms\Components\TextInput::make('label')
                            ->label('Назва')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('type')
                            ->label('Тип поля')
                            ->options([
                                'text' => 'Текст',
                                'textarea' => 'Багаторядковий текст',
                                'email' => 'Email',
                                'tel' => 'Телефон',
                                'url' => 'URL',
                                'number' => 'Число',
                                'coordinates' => 'Координати',
                            ])
                            ->default('text')
                            ->required()
                            ->reactive(),
                        Forms\Components\Select::make('group')
                            ->label('Група')
                            ->options([
                                'contact' => 'Контактна інформація',
                                'address' => 'Адреса',
                                'map' => 'Карта',
                                'social' => 'Соціальні мережі',
                            ])
                            ->default('contact')
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Значення')
                    ->schema([
                        Forms\Components\TextInput::make('value')
                            ->label('Значення')
                            ->required()
                            ->visible(fn ($get) => in_array($get('type'), ['text', 'email', 'tel', 'url', 'number', 'coordinates'])),
                        Forms\Components\Textarea::make('value')
                            ->label('Значення')
                            ->required()
                            ->rows(4)
                            ->visible(fn ($get) => $get('type') === 'textarea'),
                        Forms\Components\Textarea::make('description')
                            ->label('Опис')
                            ->rows(2)
                            ->helperText('Додаткова інформація про це налаштування'),
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Порядок сортування')
                            ->numeric()
                            ->default(0),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->label('Назва')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('key')
                    ->label('Ключ')
                    ->searchable()
                    ->copyable()
                    ->fontFamily('mono'),
                Tables\Columns\TextColumn::make('value')
                    ->label('Значення')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),
                Tables\Columns\TextColumn::make('type')
                    ->label('Тип')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'text' => 'gray',
                        'textarea' => 'blue',
                        'email' => 'green',
                        'tel' => 'yellow',
                        'url' => 'purple',
                        'number' => 'orange',
                        'coordinates' => 'red',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('group')
                    ->label('Група')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'contact' => 'blue',
                        'address' => 'green',
                        'map' => 'red',
                        'social' => 'purple',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Порядок')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Тип')
                    ->options([
                        'text' => 'Текст',
                        'textarea' => 'Багаторядковий текст',
                        'email' => 'Email',
                        'tel' => 'Телефон',
                        'url' => 'URL',
                        'number' => 'Число',
                        'coordinates' => 'Координати',
                    ]),
                Tables\Filters\SelectFilter::make('group')
                    ->label('Група')
                    ->options([
                        'contact' => 'Контактна інформація',
                        'address' => 'Адреса',
                        'map' => 'Карта',
                        'social' => 'Соціальні мережі',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order');
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
            'index' => Pages\ListContactSettings::route('/'),
            'create' => Pages\CreateContactSetting::route('/create'),
            'edit' => Pages\EditContactSetting::route('/{record}/edit'),
        ];
    }
}
