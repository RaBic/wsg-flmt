<?php

namespace App\Enums;

enum PostType: string
{
    case Blog = 'blog';
    case Event = 'event';

    public function label(): string
    {
        return match ($this) {
            self::Blog => 'Blog',
            self::Event => 'Veranstaltung',
        };
    }

    public static function toSelectOptions(): array
    {
        return [
            self::Blog->value => 'Blog',
            self::Event->value => 'Veranstaltung',
        ];
    }

    public static function types(): array
    {
        return [
            self::Blog,
            self::Event,
        ];
    }
}
