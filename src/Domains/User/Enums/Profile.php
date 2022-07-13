<?php

declare(strict_types=1);

namespace Domains\User\Enums;

enum Profile: string
{
    case USER = 'user';
    case RETAILER = 'retailer';

    /**
     * @return array<string>
     */
    public static function all(): array
    {
        return [
            self::USER->value,
            self::RETAILER->value,
        ];
    }
}
