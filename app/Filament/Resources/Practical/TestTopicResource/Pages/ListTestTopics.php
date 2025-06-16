<?php

namespace App\Filament\Resources\Practical\TestTopicResource\Pages;

use App\Filament\Resources\Practical\TestTopicResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestTopics extends ListRecords
{
    protected static string $resource = TestTopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
