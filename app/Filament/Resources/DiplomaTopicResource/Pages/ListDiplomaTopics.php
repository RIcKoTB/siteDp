<?php

namespace App\Filament\Resources\DiplomaTopicResource\Pages;

use App\Filament\Resources\DiplomaTopicResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDiplomaTopics extends ListRecords
{
    protected static string $resource = DiplomaTopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
