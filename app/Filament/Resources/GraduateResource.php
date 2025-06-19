<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GraduateResource\Pages;
use App\Models\Graduate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class GraduateResource extends Resource
{
    protected static ?string $model = Graduate::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Випускники';

    protected static ?string $modelLabel = 'Випускник';

    protected static ?string $pluralModelLabel = 'Випускники';

    protected static ?string $navigationGroup = 'Контент';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Особиста інформація')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('last_name')
                                    ->label('Прізвище')
                                    ->required()
                                    ->maxLength(255),
                                
                                Forms\Components\TextInput::make('first_name')
                                    ->label('Ім\'я')
                                    ->required()
                                    ->maxLength(255),
                                
                                Forms\Components\TextInput::make('middle_name')
                                    ->label('По батькові')
                                    ->maxLength(255),
                            ]),
                        
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('specialty')
                                    ->label('Спеціальність')
                                    ->required()
                                    ->maxLength(255),
                                
                                Forms\Components\TextInput::make('graduation_year')
                                    ->label('Рік випуску')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1990)
                                    ->maxValue(now()->year + 5),
                            ]),
                        
                        Forms\Components\FileUpload::make('photo_url')
                            ->label('Фото')
                            ->image()
                            ->directory('graduates')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '1:1',
                                '4:3',
                            ]),
                    ]),
                
                Forms\Components\Section::make('Професійна інформація')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('current_position')
                                    ->label('Поточна посада')
                                    ->maxLength(255),
                                
                                Forms\Components\TextInput::make('company')
                                    ->label('Компанія')
                                    ->maxLength(255),
                            ]),
                        
                        Forms\Components\Textarea::make('achievements')
                            ->label('Досягнення')
                            ->rows(4)
                            ->columnSpanFull(),
                        
                        Forms\Components\Textarea::make('testimonial')
                            ->label('Відгук про навчання')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
                
                Forms\Components\Section::make('Контактна інформація')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('contact_email')
                                    ->label('Email')
                                    ->email()
                                    ->maxLength(255),
                                
                                Forms\Components\TextInput::make('contact_phone')
                                    ->label('Телефон')
                                    ->tel()
                                    ->maxLength(255),
                                
                                Forms\Components\TextInput::make('linkedin_url')
                                    ->label('LinkedIn')
                                    ->url()
                                    ->maxLength(255),
                            ]),
                    ]),
                
                Forms\Components\Section::make('Налаштування')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Рекомендований')
                                    ->helperText('Показувати в блоці рекомендованих випускників'),
                                
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Активний')
                                    ->default(true),
                                
                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Порядок сортування')
                                    ->numeric()
                                    ->default(0),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo_url')
                    ->label('Фото')
                    ->circular()
                    ->size(50),
                
                Tables\Columns\TextColumn::make('full_name')
                    ->label('ПІБ')
                    ->searchable(['first_name', 'last_name', 'middle_name'])
                    ->sortable(['last_name', 'first_name']),
                
                Tables\Columns\TextColumn::make('specialty')
                    ->label('Спеціальність')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('graduation_year')
                    ->label('Рік випуску')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('current_position')
                    ->label('Посада')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('company')
                    ->label('Компанія')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(),
                
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Рекомендований')
                    ->boolean()
                    ->toggleable(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активний')
                    ->boolean(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Створено')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('graduation_year')
                    ->label('Рік випуску')
                    ->options(function () {
                        return Graduate::distinct()
                            ->orderBy('graduation_year', 'desc')
                            ->pluck('graduation_year', 'graduation_year')
                            ->toArray();
                    }),
                
                Tables\Filters\SelectFilter::make('specialty')
                    ->label('Спеціальність')
                    ->options(function () {
                        return Graduate::distinct()
                            ->orderBy('specialty')
                            ->pluck('specialty', 'specialty')
                            ->toArray();
                    }),
                
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Рекомендований'),
                
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Активний'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('toggle_featured')
                        ->label('Перемкнути рекомендований')
                        ->icon('heroicon-o-star')
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update(['is_featured' => !$record->is_featured]);
                            }
                        }),
                ]),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order');
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
            'index' => Pages\ListGraduates::route('/'),
            'create' => Pages\CreateGraduate::route('/create'),
            'view' => Pages\ViewGraduate::route('/{record}'),
            'edit' => Pages\EditGraduate::route('/{record}/edit'),
        ];
    }
}
