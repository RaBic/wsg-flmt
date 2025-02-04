<?php

namespace App\Filament\Resources\CentreResource\Pages;

use App\Filament\Resources\CentreResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCentre extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = CentreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
