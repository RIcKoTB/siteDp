<?php

namespace App\Filament\Resources\Practical\TestTimelineResource\Pages;

use App\Filament\Resources\Practical\TestTimelineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTestTimeline extends EditRecord
{
    protected static string $resource = TestTimelineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
