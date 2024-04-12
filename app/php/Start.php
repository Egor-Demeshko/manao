<?php

declare(strict_types=1);

namespace App\php;

use App\php\controller\Router;
use App\php\Utils\Actions;
use App\php\Utils\Styles;
use App\php\Utils\Scripts;
use App\php\views\SimpleHead;
use App\php\views\Body;

class Start
{
    static public function start(): void
    {
        Router::registerRoutes();
        Actions::addAction("create_simple_head", SimpleHead::class . "::createHead");

        /**STYLES EVENTS */
        Actions::addAction(Actions::ADD_STYLES, Styles::class . "::addStyles");
        Actions::addAction(Actions::ENQUEUE_STYLES, Styles::class . "::enqueueStyles");

        /**SCRIPT EVENTS */
        Actions::addAction(Actions::ADD_SCRIPTS, Scripts::class . "::addScripts");
        Actions::addAction(Actions::ENQUEUE_SCRIPTS, Scripts::class . "::enqueueScripts");

        Actions::addAction(Body::START_BODY, Body::class . "::startBody");
        Actions::addAction(Body::END_BODY, Body::class . "::endBody");
    }

    static public function processRequest(): void
    {
        $route = Router::getRequestRoute();
        $method = Router::getRequestMethod();
        Router::callRoute(method: $method, route: $route);
    }
}
