<?php

namespace App\Filament\Resources\PracticalApprovedResource\Pages;

use App\Filament\Resources\PracticalApprovedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPracticalApproved extends EditRecord
{
    protected static string $resource = PracticalApprovedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
