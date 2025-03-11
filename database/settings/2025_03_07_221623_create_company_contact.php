<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class() extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('company.email', 'wsg@wsg-online.com');

        $this->migrator->add('company.fon', '+ 49 (0) 2161 5 66 23-0');

        $this->migrator->add('company.address', 'Fliethstraße 112-114
41061 Mönchengladbach
Germany');

        $this->migrator->add('company.workhours', 'Montags bis Donnerstags: 9 - 16 Uhr
Freitags: 9 - 14 Uhr');

        $this->migrator->add('company.linkedin', 'https://www.linkedin.com/company/westdeutsche-studiengruppe-gmbh/');

        $this->migrator->add('company.instagram', 'https://instagram.com/wsg_online');
    }
};
