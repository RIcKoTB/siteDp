<?php

namespace App\Filament\Resources\EducationalComponentResource\Pages;

use App\Filament\Resources\EducationalComponentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEducationalComponents extends ListRecords
{
    protected static string $resource = EducationalComponentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
