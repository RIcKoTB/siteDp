<?php

namespace App\Filament\Resources\GraduateResource\Pages;

use App\Filament\Resources\GraduateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGraduate extends EditRecord
{
    protected static string $resource = GraduateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
