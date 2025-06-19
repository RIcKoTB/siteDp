<?php

namespace App\Filament\Resources\SurveyResponseResource\Pages;

use App\Filament\Resources\SurveyResponseResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSurveyResponse extends ViewRecord
{
    protected static string $resource = SurveyResponseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Назад до списку')
                ->icon('heroicon-o-arrow-left')
                ->url($this->getResource()::getUrl('index')),
            
            Actions\DeleteAction::make()
                ->label('Видалити відповідь'),
        ];
    }
}
