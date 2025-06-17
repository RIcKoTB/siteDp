<?php

namespace App\Filament\Resources\PracticalApplicationResource\Pages;

use App\Filament\Resources\PracticalApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPracticalApplication extends EditRecord
{
    protected static string $resource = PracticalApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
