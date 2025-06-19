<?php

namespace App\Filament\Resources\GraduateResource\Pages;

use App\Filament\Resources\GraduateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListGraduates extends ListRecords
{
    protected static string $resource = GraduateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Додати випускника'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Всі')
                ->badge(fn () => \App\Models\Graduate::count()),
            
            'active' => Tab::make('Активні')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', true))
                ->badge(fn () => \App\Models\Graduate::where('is_active', true)->count()),
            
            'featured' => Tab::make('Рекомендовані')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_featured', true))
                ->badge(fn () => \App\Models\Graduate::where('is_featured', true)->count()),
            
            'recent' => Tab::make('Останні випуски')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('graduation_year', '>=', now()->year - 2))
                ->badge(fn () => \App\Models\Graduate::where('graduation_year', '>=', now()->year - 2)->count()),
        ];
    }
}
