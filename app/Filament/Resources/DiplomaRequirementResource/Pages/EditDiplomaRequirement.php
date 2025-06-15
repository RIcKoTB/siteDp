<?php

namespace App\Filament\Resources\DiplomaRequirementResource\Pages;

use App\Filament\Resources\DiplomaRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDiplomaRequirement extends EditRecord
{
    protected static string $resource = DiplomaRequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
