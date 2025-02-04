<?php

namespace App\Filament\Resources\TeamResource\Pages;

use App\Events\ModelSorted;
use App\Filament\Resources\TeamResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTeams extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = TeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }

    public function reorderTable(array $order): void
    {
        parent::reorderTable($order);
        ModelSorted::dispatch('unit');
    }
}
