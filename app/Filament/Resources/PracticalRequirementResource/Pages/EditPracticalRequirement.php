<?php

namespace App\Filament\Resources\PracticalRequirementResource\Pages;

use App\Filament\Resources\PracticalRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPracticalRequirement extends EditRecord
{
    protected static string $resource = PracticalRequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
