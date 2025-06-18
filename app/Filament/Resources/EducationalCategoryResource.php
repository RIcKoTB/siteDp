<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationalCategoryResource\Pages;
use App\Models\EducationalCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EducationalCategoryResource extends Resource
{
    protected static ?string $model = EducationalCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    
    protected static ?string $navigationLabel = 'Категорії освітніх компонентів';
    
    protected static ?string $modelLabel = 'категорію';
    
    protected static ?string $pluralModelLabel = 'категорії';
    
    protected static ?string $navigationGroup = 'Освітні компоненти';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основна інформація')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Назва категорії')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $context, $state, callable $set) => 
                                $context === 'create' ? $set('slug', \Str::slug($state)) : null
                            ),
                        
                        Forms\Components\TextInput::make('slug')
                            ->label('URL slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->rules(['alpha_dash'])
                            ->helperText('Використовується в URL адресах'),
                        
                        Forms\Components\Textarea::make('description')
                            ->label('Опис категорії')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
                
                Forms\Components\Section::make('Оформлення')
                    ->schema([
                        Forms\Components\ColorPicker::make('color')
                            ->label('Колір категорії')
                            ->default('#3498db'),
                        
                        Forms\Components\TextInput::make('icon')
                            ->label('Іконка (емодзі)')
                            ->placeholder('📚')
                            ->maxLength(10)
                            ->helperText('Емодзі для відображення в інтерфейсі'),
                    ])->columns(2),
                
                Forms\Components\Section::make('Налаштування')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Активна категорія')
                            ->default(true)
                            ->helperText('Неактивні категорії не відображаються на сайті'),
                        
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Порядок сортування')
                            ->numeric()
                            ->default(0)
                            ->helperText('Чим менше число, тим вище в списку'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Назва')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Slug скопійовано!')
                    ->badge()
                    ->color('gray'),
                
                Tables\Columns\ColorColumn::make('color')
                    ->label('Колір'),
                
                Tables\Columns\TextColumn::make('icon')
                    ->label('Іконка')
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('components_count')
                    ->label('Кількість предметів')
                    ->alignCenter()
                    ->badge()
                    ->color('success'),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Активна')
                    ->boolean()
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Порядок')
                    ->sortable()
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Створено')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Статус')
                    ->placeholder('Всі категорії')
                    ->trueLabel('Тільки активні')
                    ->falseLabel('Тільки неактивні'),
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
            'index' => Pages\ListEducationalCategories::route('/'),
            'create' => Pages\CreateEducationalCategory::route('/create'),
            'edit' => Pages\EditEducationalCategory::route('/{record}/edit'),
        ];
    }
}
