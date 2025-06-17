<?php

namespace App\Filament\Resources\PracticalApplicationResource\Pages;

use App\Filament\Resources\PracticalApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPracticalApplications extends ListRecords
{
    protected static string $resource = PracticalApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
