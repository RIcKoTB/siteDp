<?php

namespace App\Filament\Resources\Practical\TestTopicResource\Pages;

use App\Filament\Resources\Practical\TestTopicResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTestTopic extends CreateRecord
{
    protected static string $resource = TestTopicResource::class;
}
