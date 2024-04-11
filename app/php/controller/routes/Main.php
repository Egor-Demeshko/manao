<?php

declare(strict_types=1);

namespace App\php\controller\routes;

use App\Php\Utils\Actions;

class Main
{
    public static function start(): void
    {
        self::createMainResponse();
    }

    public static function createMainResponse(): void
    {

        Actions::callAction('create_simple_head', ["title" => "Главная страница"]);
    }
}
