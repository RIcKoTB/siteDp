<?php

namespace App\Filament\Resources\ProgramOverviewResource\Pages;

use App\Filament\Resources\ProgramOverviewResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgramOverviews extends ListRecords
{
    protected static string $resource = ProgramOverviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
