<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clears the APP';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('package:discover');
        $this->call('clear-compiled');

        if (app()->isLocal()) {
            $this->call('optimize:clear');
            $this->call('event:clear');
            $this->call('ide-helper:eloquent');
            $this->call('ide-helper:generate');
            $this->call('ide-helper:models', ['--write-mixin' => true]);
            $this->call('icons:cache');
        }
        if (app()->isProduction()) {
            $this->call('optimize');
            $this->call('filament:optimize');
        }
    }
}
