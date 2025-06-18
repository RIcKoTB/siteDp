<?php

namespace App\Filament\Resources\EducationalCategoryResource\Pages;

use App\Filament\Resources\EducationalCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEducationalCategory extends EditRecord
{
    protected static string $resource = EducationalCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
