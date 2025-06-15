<?php

namespace App\Filament\Resources\DiplomaLinkResource\Pages;

use App\Filament\Resources\DiplomaLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDiplomaLinks extends ListRecords
{
    protected static string $resource = DiplomaLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
