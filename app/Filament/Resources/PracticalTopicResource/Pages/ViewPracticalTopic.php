<?php

namespace App\Filament\Resources\PracticalTopicResource\Pages;

use App\Filament\Resources\PracticalTopicResource;
use App\Models\PracticalTopic;
use App\Models\PracticalTopicSupervisor;
use App\Models\PracticalTopicStage;
use App\Models\PracticalTopicResource as TopicResourceModel;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewPracticalTopic extends ViewRecord
{
    protected static string $resource = PracticalTopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Редагувати'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Основна інформація')
                    ->schema([
                        Infolists\Components\TextEntry::make('category.title')
                            ->label('Категорія'),
                        Infolists\Components\TextEntry::make('title')
                            ->label('Назва теми'),
                        Infolists\Components\TextEntry::make('description')
                            ->label('Опис')
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('teacher')
                            ->label('Викладач'),
                        Infolists\Components\TextEntry::make('hours')
                            ->label('Кількість годин')
                            ->suffix(' год.'),
                        Infolists\Components\IconEntry::make('is_active')
                            ->label('Активна')
                            ->boolean(),
                    ])
                    ->columns(2),

                Infolists\Components\Section::make('Керівники')
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('supervisors')
                            ->label('')
                            ->schema([
                                Infolists\Components\TextEntry::make('name')
                                    ->label('Ім\'я')
                                    ->weight('bold'),
                                Infolists\Components\TextEntry::make('position')
                                    ->label('Посада'),
                                Infolists\Components\TextEntry::make('email')
                                    ->label('Email')
                                    ->copyable(),
                                Infolists\Components\TextEntry::make('phone')
                                    ->label('Телефон'),
                                Infolists\Components\TextEntry::make('bio')
                                    ->label('Біографія')
                                    ->columnSpanFull(),
                                Infolists\Components\IconEntry::make('is_primary')
                                    ->label('Основний керівник')
                                    ->boolean(),
                            ])
                            ->columns(2),
                    ]),

                Infolists\Components\Section::make('Етапи виконання')
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('stages')
                            ->label('')
                            ->schema([
                                Infolists\Components\TextEntry::make('title')
                                    ->label('Назва етапу')
                                    ->weight('bold'),
                                Infolists\Components\TextEntry::make('description')
                                    ->label('Опис')
                                    ->columnSpanFull(),
                                Infolists\Components\TextEntry::make('start_date')
                                    ->label('Дата початку')
                                    ->date('d.m.Y'),
                                Infolists\Components\TextEntry::make('end_date')
                                    ->label('Дата завершення')
                                    ->date('d.m.Y'),
                                Infolists\Components\TextEntry::make('status')
                                    ->label('Статус')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'pending' => 'warning',
                                        'in_progress' => 'info',
                                        'completed' => 'success',
                                        default => 'gray',
                                    }),
                            ])
                            ->columns(2),
                    ]),

                Infolists\Components\Section::make('Корисні ресурси')
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('topicResources')
                            ->label('')
                            ->schema([
                                Infolists\Components\TextEntry::make('title')
                                    ->label('Назва')
                                    ->weight('bold'),
                                Infolists\Components\TextEntry::make('description')
                                    ->label('Опис')
                                    ->columnSpanFull(),
                                Infolists\Components\TextEntry::make('url')
                                    ->label('Посилання')
                                    ->url(fn ($state) => $state)
                                    ->openUrlInNewTab(),
                                Infolists\Components\TextEntry::make('type')
                                    ->label('Тип')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'link' => 'primary',
                                        'file' => 'success',
                                        'book' => 'warning',
                                        'article' => 'info',
                                        'video' => 'danger',
                                        default => 'gray',
                                    }),
                                Infolists\Components\IconEntry::make('is_required')
                                    ->label('Обов\'язковий')
                                    ->boolean(),
                            ])
                            ->columns(2),
                    ]),
            ]);
    }
}
