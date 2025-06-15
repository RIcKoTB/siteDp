<?php

namespace App\Filament\Resources\PracticeScheduleResource\Pages;

use App\Filament\Resources\PracticeScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPracticeSchedules extends ListRecords
{
    protected static string $resource = PracticeScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
