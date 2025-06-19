<?php

namespace App\Filament\Resources\GraduateResource\Pages;

use App\Filament\Resources\GraduateResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGraduate extends CreateRecord
{
    protected static string $resource = GraduateResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
