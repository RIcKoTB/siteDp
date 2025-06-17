<?php

namespace App\Filament\Resources\PracticalTopicResource\Pages;

use App\Filament\Resources\PracticalTopicResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPracticalTopic extends EditRecord
{
    protected static string $resource = PracticalTopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
