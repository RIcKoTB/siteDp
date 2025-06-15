<?php

namespace App\Filament\Resources\HistoryEventResource\Pages;

use App\Filament\Resources\HistoryEventResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHistoryEvent extends EditRecord
{
    protected static string $resource = HistoryEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
