<?php

declare(strict_types=1);

namespace App\db;

use App\db\interfaces\DB;
use App\db\DBjson;

class DBCreator
{
    const JSON = 'json';
    private static $db = null;
    public static function createDB($dbID): void
    {
        self::$db = match ($dbID) {
            self::JSON => new DBjson(),
        };
    }

    public static function getDatabase(): DB
    {
        return self::$db;
    }
}
