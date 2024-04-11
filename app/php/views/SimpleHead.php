<?php

declare(strict_types=1);

namespace App\php\views;

class SimpleHead
{
    public static function createHead(string $title): void
    {

        require_once(ROOT . "/php/views/html/simplehead/headstart.php");
        require_once(ROOT . "/php/views/html/simplehead/headend.php");
    }
}
