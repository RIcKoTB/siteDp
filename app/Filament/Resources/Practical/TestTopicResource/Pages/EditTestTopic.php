<?php

namespace App\Filament\Resources\Practical\TestTopicResource\Pages;

use App\Filament\Resources\Practical\TestTopicResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTestTopic extends EditRecord
{
    protected static string $resource = TestTopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
