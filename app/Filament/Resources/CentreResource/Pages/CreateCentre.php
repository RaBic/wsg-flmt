<?php

namespace App\Filament\Resources\CentreResource\Pages;

use App\Filament\Resources\CentreResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCentre extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = CentreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
