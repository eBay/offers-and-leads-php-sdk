<?php

declare(strict_types=1);

namespace EBay\OffersAndLeads\Configuration;

final class TokenContext
{
    private static ?string $current = null;

    public static function set(?string $token): void
    {
        self::$current = $token;
    }

    public static function get(): ?string
    {
        return self::$current;
    }

    /** Sets token, runs callable, restores previous value. */
    public static function runWith(?string $token, callable $op): mixed
    {
        $prev = self::$current;
        self::$current = $token;
        try {
            return $op();
        } finally {
            self::$current = $prev;
        }
    }
}
