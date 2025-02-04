<?php

namespace App\Filament\Resources\StudyResource\Pages;

use App\Events\ModelSorted;
use App\Filament\Resources\StudyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudies extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = StudyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }

    /**
     * @param  array<int | string>  $order
     *
     * overwriting the reorderTable method
     * to dispatch the ModelSorted event
     * for an entry in model changelog
     */
    public function reorderTable(array $order): void
    {
        parent::reorderTable($order);
        ModelSorted::dispatch('study');
    }
}
