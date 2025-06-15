<?php

namespace App\Filament\Resources\PracticeScheduleResource\Pages;

use App\Filament\Resources\PracticeScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPracticeSchedule extends EditRecord
{
    protected static string $resource = PracticeScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
