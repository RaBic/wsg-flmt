<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class CompanyContact extends Settings
{
    public string $email;

    public ?string $fon;

    public ?string $fax;

    public string $address;

    public ?string $linkedin;

    public ?string $instagram;

    public static function group(): string
    {
        return 'company';
    }
}
