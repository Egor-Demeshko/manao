<?php

declare(strict_types=1);

namespace App\php\controller\routes;

class Login
{
    const ROUTE = "login";

    public static function start_GET(): never
    {
        header("Content-Type: application/json; charset=UTF-8");
        $response = [];
        $fields = [
            'login' => ['text' => 'Логин', 'type' => 'text'],
            'password' => ['text' => 'Пароль', 'type' => 'password'],
        ];
        $buttonText = "Войти";

        ob_start();
        require_once(ROOT . "/php/views/html/form.php");
        $response["html"] = ob_get_clean();

        $response["css"] = "/src/dist/loginForm.css";
        $response["js"] = "/src/dist/loginForm.js";

        echo json_encode($response);
        die;
    }


    public static function start_POST(): void
    {
        var_dump("LOGIN POST");
    }


    public static function logout(): void
    {
        var_dump("LOGOUT CALL");
    }
}
