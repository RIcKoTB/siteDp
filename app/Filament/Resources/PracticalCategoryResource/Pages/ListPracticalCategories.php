<?php

namespace App\Filament\Resources\PracticalCategoryResource\Pages;

use App\Filament\Resources\PracticalCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPracticalCategories extends ListRecords
{
    protected static string $resource = PracticalCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
