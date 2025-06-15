<?php

namespace App\Filament\Resources\PracticeModuleResource\Pages;

use App\Filament\Resources\PracticeModuleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPracticeModules extends ListRecords
{
    protected static string $resource = PracticeModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
