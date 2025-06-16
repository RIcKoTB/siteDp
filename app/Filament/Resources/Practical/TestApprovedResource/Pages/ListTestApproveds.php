<?php

namespace App\Filament\Resources\Practical\TestApprovedResource\Pages;

use App\Filament\Resources\Practical\TestApprovedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestApproveds extends ListRecords
{
    protected static string $resource = TestApprovedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
