<?php

declare(strict_types=1);

namespace App\Php\Views;

use App\php\Utils\Actions;


class SimpleHead
{
    public static function createHead(string $title, string $description): void
    {

        require_once(ROOT . "/php/views/html/simplehead/headstart.php");
        Actions::callAction(Actions::ENQUEUE_STYLES, []);
        require_once(ROOT . "/php/views/html/simplehead/headend.php");
    }
}
