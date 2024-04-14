<?php

declare(strict_types=1);

namespace App\php\controller\routes;

use App\php\utils\validation\errors\aggregatedResponse\ValidationResponseError;
use App\php\utils\validation\ValidationEntryPoint;
use App\php\utils\validation\errors\ValidationError;
use App\db\DBCreator;


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
        $errors = ["status" => "true"];
        ["login" => $login, "password" => $password, "email" => $email] = $_POST;
        $fields = ["login" => $login, "password" => $password, "email" => $email];

        self::validateFields($fields);

        self::loginUser($fields);
    }


    public static function validateFields(array $fields): void
    {
        foreach ($fields as $field => $value) {
            try {
                $fields[$field] = trim($value);

                ValidationEntryPoint::generateValidationRoutes($value, $field);
            } catch (ValidationError $e) {
                $errors[$e->getFieldSlug()] = $e->getErrorMessage();
            }
        }

        if (count($errors) > 1) {
            $errors["status"] = "false";
            throw new ValidationResponseError($errors);
        }
    }

    public static function loginUser(array $fields): void
    {
        $db = DBCreator::getDatabase();

        if (!$db->isRecordExists($fields["email"], $fields["login"])) {
            $errors["status"] = "false";
            $errors["email"] = "Пользователь с таким email или логином не существует";
            $errors["login"] = "Пользователь с таким email или логином не существует";
            throw new ValidationResponseError($errors);
        };

        $passwordcheckResult = $db->checkPassword($fields["email"], $fields["login"], $fields["password"]);

        if (!$passwordcheckResult) {
            $errors["status"] = "false";
            $errors["login"] = "Неправильный логин, пароль или email";
        }
    }


    public static function logout(): void
    {
        var_dump("LOGOUT CALL");
    }
}
