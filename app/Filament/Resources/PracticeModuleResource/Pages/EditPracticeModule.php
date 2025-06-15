<?php

namespace App\Filament\Resources\PracticeModuleResource\Pages;

use App\Filament\Resources\PracticeModuleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPracticeModule extends EditRecord
{
    protected static string $resource = PracticeModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
