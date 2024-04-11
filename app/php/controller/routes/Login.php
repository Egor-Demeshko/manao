<?php

declare(strict_types=1);

namespace App\php\controller\routes;

class Login
{

    public static function start(): void
    {
        var_dump("LOGIN CALL");
    }


    public static function logout(): void
    {
        var_dump("LOGOUT CALL");
    }
}
