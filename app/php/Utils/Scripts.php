<?php

declare(strict_types=1);

namespace App\Php\Utils;


class Scripts

{
    private static $list = [];
    static public function addScripts(string $src): void
    {
        if (!isset(self::$list[$src])) {
            self::$list[$src] = true;
        }
    }

    static public function enqueueScripts(): void
    {
        foreach (self::$list as $src => $status) {
            echo '<script src="' . $src . '" type="module"></script>';
        }
    }
}
