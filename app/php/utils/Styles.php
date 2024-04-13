<?php

declare(strict_types=1);

namespace App\php\Utils;

class Styles
{
    private static $list = [];

    public static function addStyles(string $src): void
    {
        if (!isset(self::$list[$src])) {
            self::$list[$src] = true;
        }
    }

    public static function enqueueStyles(): void
    {
        foreach (self::getStyles() as $src => $status) {
            echo '<link rel="stylesheet" href="' . $src . '">';
        }
    }


    private static function getStyles(): array
    {
        return self::$list;
    }
}
