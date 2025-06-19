<?php

namespace App\Filament\Resources\SurveyResponseResource\Pages;

use App\Filament\Resources\SurveyResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListSurveyResponses extends ListRecords
{
    protected static string $resource = SurveyResponseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('export')
                ->label('Експорт результатів')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    // Тут можна додати логіку експорту
                    $this->notify('success', 'Експорт буде реалізований пізніше');
                }),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Всі відповіді')
                ->badge(fn () => \App\Models\SurveyResponse::count()),
            
            'today' => Tab::make('Сьогодні')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereDate('created_at', today()))
                ->badge(fn () => \App\Models\SurveyResponse::whereDate('created_at', today())->count()),
            
            'this_week' => Tab::make('Цього тижня')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]))
                ->badge(fn () => \App\Models\SurveyResponse::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count()),
            
            'this_month' => Tab::make('Цього місяця')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereMonth('created_at', now()->month))
                ->badge(fn () => \App\Models\SurveyResponse::whereMonth('created_at', now()->month)->count()),
        ];
    }
}
