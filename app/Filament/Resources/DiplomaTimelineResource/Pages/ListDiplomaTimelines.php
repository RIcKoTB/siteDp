<?php

namespace App\Filament\Resources\DiplomaTimelineResource\Pages;

use App\Filament\Resources\DiplomaTimelineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDiplomaTimelines extends ListRecords
{
    protected static string $resource = DiplomaTimelineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
