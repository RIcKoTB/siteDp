<?php

namespace App\Filament\Resources\Practical\TestConsultationResource\Pages;

use App\Filament\Resources\Practical\TestConsultationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestConsultations extends ListRecords
{
    protected static string $resource = TestConsultationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
