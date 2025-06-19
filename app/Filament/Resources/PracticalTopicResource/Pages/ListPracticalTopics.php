<?php

namespace App\Filament\Resources\PracticalTopicResource\Pages;

use App\Filament\Resources\PracticalTopicResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPracticalTopics extends ListRecords
{
    protected static string $resource = PracticalTopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
