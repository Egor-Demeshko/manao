<?php

declare(strict_types=1);

namespace App\Php\Views;

class NavBar
{

    public static function createNavBar(): void
    {
        require_once(ROOT . "/php/views/html/navBar/navBar.php");
    }
}
