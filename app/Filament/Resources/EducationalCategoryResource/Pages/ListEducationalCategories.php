<?php

namespace App\Filament\Resources\EducationalCategoryResource\Pages;

use App\Filament\Resources\EducationalCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEducationalCategories extends ListRecords
{
    protected static string $resource = EducationalCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
