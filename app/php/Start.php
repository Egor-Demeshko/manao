<?php

declare(strict_types=1);

namespace App\php;

use App\php\controller\Router;
use App\php\Utils\Actions;
use App\php\views\SimpleHead;

class Start
{
    static public function start(): void
    {
        Router::registerRoutes();
        Actions::addAction("create_simple_head", SimpleHead::class . "::createHead");
    }

    static public function processRequest(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $route = str_replace('/', '', $_SERVER['REQUEST_URI']);

        Router::callRoute(method: $method, route: $route);
    }
}
