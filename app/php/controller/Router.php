<?php

declare(strict_types=1);

namespace App\php\controller;

use App\php\controller\routes\Login;
use App\php\controller\routes\Register;
use App\php\controller\routes\Main;

class Router
{
    private static array $routes = [];
    private function __construct()
    {
    }

    static public function registerRoutes()
    {
        self::$routes["login"] = Login::class . "::start";
        self::$routes["register"] = Register::class . "::start";
        self::$routes["logout"] = Login::class . "::logout";
        self::$routes[""] = Main::class . "::start";
    }

    static public function callRoute(string $route, string $method = "GET", array $params = [])
    {

        if (array_key_exists($route, self::$routes)) {
            call_user_func_array(self::$routes[$route], $params);
        }
    }
}
