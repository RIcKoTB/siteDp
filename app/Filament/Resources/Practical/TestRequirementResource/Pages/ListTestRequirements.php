<?php

namespace App\Filament\Resources\Practical\TestRequirementResource\Pages;

use App\Filament\Resources\Practical\TestRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestRequirements extends ListRecords
{
    protected static string $resource = TestRequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
