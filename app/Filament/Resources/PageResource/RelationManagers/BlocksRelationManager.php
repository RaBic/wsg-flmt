<?php

namespace App\Filament\Resources\PageResource\RelationManagers;

use App\Filament\Concerns\HasBlockFormTrait;
use App\Filament\Concerns\HasBlockTableTrait;
use Filament\Resources\RelationManagers\Concerns\Translatable;
use Filament\Resources\RelationManagers\RelationManager;

class BlocksRelationManager extends RelationManager
{
    use HasBlockFormTrait;
    use HasBlockTableTrait;
    use Translatable;

    protected static string $relationship = 'blocks';

    protected static ?string $title = 'Abschnitte';

    protected static bool $isLazy = false;
}
