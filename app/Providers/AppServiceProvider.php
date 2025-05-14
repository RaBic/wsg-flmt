<?php

namespace App\Providers;

use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the service the contract
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::pattern('id', '[0-9]+');

        FilamentAsset::register([
            Css::make('custom-stylesheet', __DIR__ . '/../../resources/css/customize-fi-panel.css'),
            Js::make('custom-script', __DIR__ . '/../../resources/js/customize-fi-panel.js'),
        ]);

        Table::configureUsing(function (Table $table): void {
            $table->striped()
                ->persistFiltersInSession()
                ->persistSearchInSession()
                ->persistSortInSession();
        });

        /* Model::shouldBeStrict(!$this->app->environment('production')); */
        Model::preventLazyLoading(! $this->app->environment('production'));
        /* Model::preventSilentlyDiscardingAttributes(!$this->app->environment('production')); */
        Model::preventAccessingMissingAttributes(! $this->app->environment('production'));
    }
}
