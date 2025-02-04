<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class() extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('agentur.email', 'office@agenturmosblech.de');

        $this->migrator->add('agentur.fon', '+49-30-64094770');

        $this->migrator->add('agentur.mobile', '+49-172-3018349');

        $this->migrator->add('agentur.fax', '+49-30-64094772');

        $this->migrator->add('agentur.address', 'Agentur Mosblech
Management Andreas Denker
Straße 48 Nr. 46
13125 Berlin');

        $this->migrator->add('agentur.facebook', 'https://www.facebook.com/DenkerAndreas');

        $this->migrator->add('agentur.instagram', 'https://instagram.com/agenturmosblech');
    }
};
