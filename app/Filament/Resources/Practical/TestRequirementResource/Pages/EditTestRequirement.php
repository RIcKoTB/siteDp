<?php

namespace App\Filament\Resources\Practical\TestRequirementResource\Pages;

use App\Filament\Resources\Practical\TestRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTestRequirement extends EditRecord
{
    protected static string $resource = TestRequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
