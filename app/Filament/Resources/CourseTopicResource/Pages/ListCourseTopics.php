<?php

namespace App\Filament\Resources\CourseTopicResource\Pages;

use App\Filament\Resources\CourseTopicResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCourseTopics extends ListRecords
{
    protected static string $resource = CourseTopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
