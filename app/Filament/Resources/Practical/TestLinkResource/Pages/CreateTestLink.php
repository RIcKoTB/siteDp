<?php

namespace App\Filament\Resources\Practical\TestLinkResource\Pages;

use App\Filament\Resources\Practical\TestLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTestLink extends CreateRecord
{
    protected static string $resource = TestLinkResource::class;
}
