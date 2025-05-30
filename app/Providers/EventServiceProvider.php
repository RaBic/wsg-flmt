<?php

namespace App\Providers;

use App\Events;
use App\Listeners;
use App\Observers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Spatie\LaravelSettings\Events\SettingsSaved;

// use Spatie\LaravelSettings\Models\SettingsProperty;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        Events\ModelSorted::class => [
            Listeners\AddToChangeLog::class,
        ],

        SettingsSaved::class => [
            Listeners\AddToChangeLog::class,
        ],
    ];

    /**
     * The model observers to register.
     *
     * @var array<string, string|object|array<int, string|object>>
     */
    protected $observers = [];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // Register any other events for your application
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
