<?php

declare(strict_types=1);

namespace App\php\controller;

use App\php\controller\routes\Login;
use App\php\controller\routes\Register;
use App\php\controller\routes\Main;

class Router
{
    const GET = "GET";
    const POST = "POST";

    private static array $routes = [];
    private function __construct()
    {
    }

    static public function registerRoutes()
    {
        $method = self::getRequestMethod();
        $route = self::getRequestRoute();

        if ($route === Login::ROUTE && ($method === self::GET || $method === self::POST)) {
            self::$routes["login"][$method] = Login::class . "::start" . "_$method";
        } else if ($route === Register::ROUTE && ($method === self::GET || $method === self::POST)) {
            self::$routes["register"][$method] = Register::class . "::start" . "_$method";
        }
        self::$routes["logout"][self::GET] = Login::class . "::logout";
        self::$routes[""][self::GET] = Main::class . "::start";
    }

    static public function callRoute(string $route, string $method = "GET", array $params = [])
    {

        if (array_key_exists($route, self::$routes)) {
            call_user_func_array(self::$routes[$route][$method], $params);
        }
    }

    static public function getRequestRoute(): string
    {
        return str_replace('/', '', $_SERVER['REQUEST_URI']);
    }

    static public function getRequestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
