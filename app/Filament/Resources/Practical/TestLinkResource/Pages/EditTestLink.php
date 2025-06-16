<?php

namespace App\Filament\Resources\Practical\TestLinkResource\Pages;

use App\Filament\Resources\Practical\TestLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTestLink extends EditRecord
{
    protected static string $resource = TestLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
