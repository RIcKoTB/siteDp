<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SurveyResponseResource\Pages;
use App\Models\SurveyResponse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\RepeatableEntry;

class SurveyResponseResource extends Resource
{
    protected static ?string $model = SurveyResponse::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'Результати опитувань';

    protected static ?string $modelLabel = 'Результат опитування';

    protected static ?string $pluralModelLabel = 'Результати опитувань';

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
                
                Forms\Components\Textarea::make('answers')
                    ->label('Відповіді (JSON)')
                    ->disabled()
                    ->rows(10),
                
                Forms\Components\TextInput::make('ip_address')
                    ->label('IP адреса')
                    ->disabled(),
                
                Forms\Components\Textarea::make('user_agent')
                    ->label('Браузер')
                    ->disabled()
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('survey.title')
                    ->label('Опитування')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Користувач')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата проходження')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP адреса')
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\BadgeColumn::make('survey.status')
                    ->label('Статус опитування')
                    ->colors([
                        'success' => 'Активне',
                        'warning' => 'Заплановане',
                        'danger' => 'Завершене',
                    ])
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('survey')
                    ->label('Опитування')
                    ->relationship('survey', 'title'),
                
                Tables\Filters\Filter::make('created_at')
                    ->label('Дата проходження')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Від'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('До'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
                        
                        TextEntry::make('created_at')
                            ->label('Дата проходження')
                            ->dateTime('d.m.Y H:i:s'),
                        
                        TextEntry::make('ip_address')
                            ->label('IP адреса'),
                        
                        TextEntry::make('user_agent')
                            ->label('Браузер')
                            ->limit(100),
                    ])
                    ->columns(2),
                
                Section::make('Відповіді на питання')
                    ->schema([
                        TextEntry::make('formatted_answers')
                            ->label('')
                            ->html()
                            ->getStateUsing(function (SurveyResponse $record): string {
                                $survey = $record->survey;
                                $answers = $record->answers;
                                $html = '';
                                
                                foreach ($survey->questions as $index => $question) {
                                    $answer = $answers[$index] ?? 'Не відповів';
                                    
                                    $html .= '<div style="margin-bottom: 1.5rem; padding: 1rem; background: #f8f9fa; border-radius: 8px;">';
                                    $html .= '<h4 style="margin: 0 0 0.5rem 0; color: #2c3e50;">' . ($index + 1) . '. ' . $question['question'] . '</h4>';
                                    
                                    if (is_array($answer)) {
                                        $html .= '<p style="margin: 0; color: #28a745; font-weight: 500;">• ' . implode('<br>• ', $answer) . '</p>';
                                    } else {
                                        $html .= '<p style="margin: 0; color: #28a745; font-weight: 500;">' . $answer . '</p>';
                                    }
                                    
                                    $html .= '</div>';
                                }
                                
                                return $html;
                            }),
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
}
