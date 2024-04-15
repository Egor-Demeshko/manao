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
    const LOGOUT = "logout";

    public static function start_GET(): never
    {
        header("Content-Type: application/json; charset=UTF-8");
        $response = [];
        $fields = [
            'login' => ['id' => 'login', 'text' => 'Логин', 'type' => 'text'],
            'email' => ['id' => 'email', 'text' => 'Email', 'type' => 'text'],
            'password' => ['id' => 'password', 'text' => 'Пароль', 'type' => 'password'],
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
        ["login" => $login, "password" => $password, "email" => $email] = $_POST;
        $fields = ["login" => $login, "password" => $password, "email" => $email];

        self::validateFields($fields);

        self::loginUser($fields);
    }


    public static function validateFields(array $fields): void
    {
        $errors = ["status" => "true"];
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

    public static function loginUser(array $fields): never
    {
        $db = DBCreator::getDatabase();

        if (!$db->isRecordExists($fields["email"], $fields["login"])) {
            $errors["status"] = "false";
            $errors["email"] = "Пользователь с таким email или логином не существует";
            $errors["login"] = "Пользователь с таким email или логином не существует";
            throw new ValidationResponseError($errors);
        };

        $passwordcheckResult = $db->checkRecordField('password', $fields["password"], $fields["email"], $fields["login"]);

        if (!$passwordcheckResult) {
            $errors["status"] = "false";
            $errors["login"] = "Неправильный логин, пароль или email";
            echo $errors;
            die;
        }

        $_SESSION['login'] = $fields['login'];
        echo json_encode(['status' => 'true']);
        die;
    }


    public static function logout(): void
    {
        if (isset($_SESSION["login"])) {
            unset($_SESSION["login"]);
            echo json_encode(['status' => 'true']);
            die;
        }

        echo json_encode(['status' => 'false']);
        die;
    }
}
