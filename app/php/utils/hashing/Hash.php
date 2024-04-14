<?php

declare(strict_types=1);

namespace App\php\utils\hashing;

class Hash
{

    public static function hash(string $type, string $string, string $salt = ''): string
    {
        return match ($type) {
            'md5' => self::makeMd5($string, $salt),
        };
    }


    public static function makeMd5(string $string, string $salt): string
    {
        return md5($salt . $string);
    }
}
