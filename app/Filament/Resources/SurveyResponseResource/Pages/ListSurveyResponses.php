<?php

namespace App\Filament\Resources\SurveyResponseResource\Pages;

use App\Filament\Resources\SurveyResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Survey;

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
                    $this->notify('success', 'Експорт буде доданий пізніше');
                }),
        ];
    }
    
    public function getTabs(): array
    {
        $tabs = [
            'all' => Tab::make('Всі результати')
                ->badge($this->getModel()::count()),
        ];
        
        // Додаємо вкладки для кожного опитування
        $surveys = Survey::withCount('responses')->get();
        
        foreach ($surveys as $survey) {
            $tabs["survey_{$survey->id}"] = Tab::make($survey->title)
                ->badge($survey->responses_count)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('survey_id', $survey->id));
        }
        
        return $tabs;
    }
}
