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

    /**
     * Get the enum values as an array of options for a select input.
     *
     * @return array<string, string>
     */
    public static function toSelectOptions(): array
    {
        return [
            self::Blog->value => 'Blog',
            self::Event->value => 'Veranstaltung',
        ];
    }

    /**
     * Get the enum values as an array of types.
     *
     * @return list<string>
     */
    public static function types(): array
    {
        return [
            self::Blog->value,
            self::Event->value,
        ];
    }
}
