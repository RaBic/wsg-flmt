<?php

namespace App\Filament\DashboardWidgets;

use Filament\Widgets\FilamentInfoWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class FilamentInfoWidget extends BaseWidget
{
    public static function canView(): bool
    {
        // Only show the widget to admins
        // return Filament::auth()->user()...;
        return Auth::user()->hasRole('super_admin');
    }
}
