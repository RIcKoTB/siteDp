<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SurveyResponseResource\Pages;
use App\Filament\Resources\SurveyResponseResource\RelationManagers;
use App\Models\SurveyResponse;
use App\Models\Survey;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\RepeatableEntry;

class SurveyResponseResource extends Resource
{
    protected static ?string $model = SurveyResponse::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    
    protected static ?string $navigationLabel = 'Результати опитувань';
    
    protected static ?string $navigationGroup = 'Опитування';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('survey_id')
                    ->label('Опитування')
                    ->relationship('survey', 'title')
                    ->required()
                    ->disabled(),
                    
                Forms\Components\Select::make('user_id')
                    ->label('Користувач')
                    ->relationship('user', 'name')
                    ->required()
                    ->disabled(),
                    
                Forms\Components\Textarea::make('ip_address')
                    ->label('IP адреса')
                    ->disabled(),
                    
                Forms\Components\Textarea::make('user_agent')
                    ->label('Браузер')
                    ->disabled(),
                    
                Forms\Components\DateTimePicker::make('completed_at')
                    ->label('Дата завершення')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('survey.title')
                    ->label('Опитування')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('user.name')
                    ->label('Користувач')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(),
                    
                TextColumn::make('completed_at')
                    ->label('Дата завершення')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
                    
                TextColumn::make('answers_count')
                    ->label('Кількість відповідей')
                    ->getStateUsing(function (SurveyResponse $record) {
                        return is_array($record->answers) ? count($record->answers) : 0;
                    })
                    ->badge()
                    ->color('success'),
                    
                TextColumn::make('ip_address')
                    ->label('IP адреса')
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('created_at')
                    ->label('Створено')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('survey_id')
                    ->label('Опитування')
                    ->relationship('survey', 'title')
                    ->multiple(),
                    
                SelectFilter::make('user_id')
                    ->label('Користувач')
                    ->relationship('user', 'name')
                    ->searchable(),
                    
                Filter::make('completed_at')
                    ->form([
                        DatePicker::make('completed_from')
                            ->label('Завершено з'),
                        DatePicker::make('completed_until')
                            ->label('Завершено до'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['completed_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('completed_at', '>=', $date),
                            )
                            ->when(
                                $data['completed_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('completed_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('completed_at', 'desc');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Інформація про відповідь')
                    ->schema([
                        TextEntry::make('survey.title')
                            ->label('Опитування'),
                            
                        TextEntry::make('user.name')
                            ->label('Користувач'),
                            
                        TextEntry::make('user.email')
                            ->label('Email користувача'),
                            
                        TextEntry::make('completed_at')
                            ->label('Дата завершення')
                            ->dateTime('d.m.Y H:i'),
                            
                        TextEntry::make('ip_address')
                            ->label('IP адреса'),
                            
                        TextEntry::make('user_agent')
                            ->label('Браузер')
                            ->limit(50),
                    ])
                    ->columns(2),
                    
                Section::make('Відповіді користувача')
                    ->schema([
                        TextEntry::make('answers')
                            ->label('')
                            ->formatStateUsing(function (SurveyResponse $record) {
                                if (!$record->survey || !$record->answers) {
                                    return 'Немає відповідей';
                                }
                                
                                $html = '';
                                foreach ($record->survey->questions as $index => $question) {
                                    $answer = $record->answers[$index] ?? 'Не відповів';
                                    
                                    $html .= '<div style="margin-bottom: 1rem; padding: 1rem; background: #f8f9fa; border-radius: 8px;">';
                                    $html .= '<strong>' . ($index + 1) . '. ' . $question['question'] . '</strong><br>';
                                    
                                    if (is_array($answer)) {
                                        $html .= '<ul>';
                                        foreach ($answer as $item) {
                                            $html .= '<li>' . htmlspecialchars($item) . '</li>';
                                        }
                                        $html .= '</ul>';
                                    } else {
                                        $html .= '<span style="color: #28a745; font-weight: 500;">' . htmlspecialchars($answer) . '</span>';
                                    }
                                    
                                    $html .= '</div>';
                                }
                                
                                return $html;
                            })
                            ->html(),
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
            'index' => Pages\ListSurveyResponses::route('/'),
            'view' => Pages\ViewSurveyResponse::route('/{record}'),
        ];
    }
    
    public static function canCreate(): bool
    {
        return false; // Заборонити створення через адмін-панель
    }
    
    public static function canEdit($record): bool
    {
        return false; // Заборонити редагування
    }
}
