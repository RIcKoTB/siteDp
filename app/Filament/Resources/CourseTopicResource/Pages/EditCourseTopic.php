<?php

namespace App\Filament\Resources\CourseTopicResource\Pages;

use App\Filament\Resources\CourseTopicResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCourseTopic extends EditRecord
{
    protected static string $resource = CourseTopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
