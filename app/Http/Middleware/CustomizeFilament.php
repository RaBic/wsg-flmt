<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CustomizeFilament
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (Auth::user() && ! Auth::user()->hasRole('super_admin')) {
            config(['filament-breezy.enable_sanctum' => false]);
        }

        return $next($request);
    }
}
