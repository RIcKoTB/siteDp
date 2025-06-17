<?php

namespace App\Filament\Resources\PracticalConsultationResource\Pages;

use App\Filament\Resources\PracticalConsultationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPracticalConsultation extends EditRecord
{
    protected static string $resource = PracticalConsultationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
