<?php

namespace App\Enums;

enum StudyType: string
{
    case Recruiting = 'recruiting';
    case FollowUp = 'followup';

    public function label(): string
    {
        return match ($this) {
            self::Recruiting => 'Rekrutierende Studie',
            self::FollowUp => 'Studie im Follow up',
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
            self::Recruiting->value => 'Rekrutierende Studie',
            self::FollowUp->value => 'Studie im Follow up',
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
            self::Recruiting->value,
            self::FollowUp->value,
        ];
    }
}
