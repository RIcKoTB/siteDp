<?php

namespace App\Filament\Resources\EducationalComponentResource\Pages;

use App\Filament\Resources\EducationalComponentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEducationalComponent extends EditRecord
{
    protected static string $resource = EducationalComponentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
