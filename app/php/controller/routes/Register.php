<?php

declare(strict_types=1);

namespace App\Php\Controller\Routes;

use App\php\utils\validation\ValidationEntryPoint;


class Register
{
    const ROUTE = 'register';

    public static function start_GET(): never
    {
        header("Content-Type: application/json; charset=UTF-8");
        $response = [];
        $fields = [
            'login' => ['id' => 'login', 'text' => 'Логин', 'type' => 'text', 'required' => "true"],
            'password' => ['id' => 'password', 'text' => 'Пароль', 'type' => 'password', 'required' => "true"],
            'password_check' => ['id' => 'password_check', 'text' => 'Повторите пароль', 'type' => 'password', 'required' => "true"],
            'email' => ['id' => 'email', 'text' => 'Email', 'type' => 'email', 'required' => "true"],
        ];
        $buttonText = "Зарегистрироваться";

        ob_start();
        require_once(ROOT . "/php/views/html/form.php");
        $response["html"] = ob_get_clean();

        $response["css"] = "/src/dist/loginForm.css";
        $response["js"] = "/src/dist/loginForm.js";

        echo json_encode($response);
        die;
    }

    public static function start_POST(): never
    {
        //из массива post получить поля email, password, password2, 
        //ВАЛИДИРУЕМ
        //1. email на правильность ввода
        //2. пароли что они совпадают
        //3. логин не занят
        // ответ будет такой
        // slug поля => "Сообщение".

        ["login" => $login, "password" => $password, "password_check" => $password_check, "email" => $email] = $_POST;
        if (isset($login) && isset($password) && isset($email) && isset($password_check)) {
            self::startValidation([
                "login" => $login,
                "password" => $password,
                "email" => $email,
                "password_check" => $password_check
            ]);
        }

        die;
    }

    public static function startValidation(array $fields): void
    {
        foreach ($fields as $field => $value) {

            ValidationEntryPoint::validate($value, $field);
        }
    }
}
