<?php

declare(strict_types=1);

namespace App\Php\Controller\Routes;

use App\Php\Utils\Actions;
use App\Php\Views\Body;
use App\php\views\NavBar;

class Main
{
    public static function start(): void
    {
        self::createMainResponse();
    }

    public static function createMainResponse(): void
    {
        self::addStylesScripts();
        Actions::callAction('create_simple_head', ["title" => "Главная страница", "description" => "Это самая крутая главная страница."]);
        self::createMainBlock();
    }

    public static function createMainBlock(): void
    {
        Actions::callAction(Body::START_BODY, []);

        NavBar::createNavBar();
        self::getMainContent();


        Actions::callAction(Actions::ENQUEUE_SCRIPTS, []);
        Actions::callAction(Body::END_BODY, []);
    }

    private static function addStylesScripts(): void
    {
        Actions::callAction(Actions::ADD_STYLES, ["src" => "/src/dist/main.css"]);
        Actions::callAction(Actions::ADD_SCRIPTS, ["src" => "/src/dist/main.js"]);
    }

    private static function getMainContent(): void
    {
        require_once(ROOT . "/php/views/html/main/main.php");
    }
}
