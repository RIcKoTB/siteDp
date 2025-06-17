<?php

namespace App\Filament\Resources\GalleryResource\Pages;

use App\Filament\Resources\GalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGalleries extends ListRecords
{
    protected static string $resource = GalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Додати фото'),
            Actions\Action::make('bulk_upload')
                ->label('Масове завантаження')
                ->icon('heroicon-o-cloud-arrow-up')
                ->color('success')
                ->url(static::getResource()::getUrl('bulk-upload')),
        ];
    }
}
