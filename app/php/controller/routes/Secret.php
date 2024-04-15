<?php

declare(strict_types=1);

namespace App\Php\Controller\Routes;

use App\Php\Utils\Actions;
use App\Php\Views\Body;
use App\php\views\NavBar;

class Secret
{
    const ROUTE = "secret";
    public static function start(): void
    {
        self::createResponse();
    }

    public static function createResponse(): void
    {
        self::addStylesScripts();
        Actions::callAction('create_simple_head', ["title" => "Секретная страница", "description" => "Сюда нельзя просто так попасть. Ведь так?"]);
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
        $title = "Секретная страница";
        $helloText = IS_SESSION ? "УРА, ВЫ АВТОРИЗОВАНЫ НА САЙТЕ И ВАМ ДОСТУПНА СЕКРЕТНАЯ СТРАНИЦА" :
            "Похоже ВАМ необходимо зарегистрироваться, или войти.";
        require_once(ROOT . "/php/views/html/main/main.php");
    }
}
