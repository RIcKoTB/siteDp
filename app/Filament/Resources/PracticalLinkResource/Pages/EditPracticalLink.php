<?php

namespace App\Filament\Resources\PracticalLinkResource\Pages;

use App\Filament\Resources\PracticalLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPracticalLink extends EditRecord
{
    protected static string $resource = PracticalLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
