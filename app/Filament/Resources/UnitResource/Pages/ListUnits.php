<?php

namespace App\Filament\Resources\UnitResource\Pages;

use App\Events\ModelSorted;
use App\Filament\Resources\UnitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUnits extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = UnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }

    public function reorderTable(array $order): void
    {
        parent::reorderTable($order);
        ModelSorted::dispatch('unit');
    }
}
