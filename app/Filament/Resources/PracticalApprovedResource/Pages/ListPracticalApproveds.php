<?php

namespace App\Filament\Resources\PracticalApprovedResource\Pages;

use App\Filament\Resources\PracticalApprovedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPracticalApproveds extends ListRecords
{
    protected static string $resource = PracticalApprovedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
