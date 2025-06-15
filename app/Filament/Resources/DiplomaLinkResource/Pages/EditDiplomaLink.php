<?php

namespace App\Filament\Resources\DiplomaLinkResource\Pages;

use App\Filament\Resources\DiplomaLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDiplomaLink extends EditRecord
{
    protected static string $resource = DiplomaLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
