<?php

declare(strict_types=1);

namespace App\Php\Controller\Routes;

use App\php\utils\validation\ValidationEntryPoint;
use App\php\utils\validation\errors\ValidationError;
use App\php\utils\validation\errors\aggregatedResponse\ValidationResponseError;
use App\db\DBCreator;


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
        /**@type string|null */
        $password_check = $fields['password_check'];
        unset($fields['password_check']);


        self::goThroughFields($fields, $password_check);

        self::registerUser($fields);
    }

    protected static function goThroughFields(array $fields, string $password_check)
    {
        $errors = ["status" => "true"];
        foreach ($fields as $field => $value) {
            try {

                $fields[$field] = trim($value);

                if ($field === 'password') {
                    ValidationEntryPoint::generateValidationRoutes($value, $field, $password_check);
                } else {
                    ValidationEntryPoint::generateValidationRoutes($value, $field);
                }
            } catch (ValidationError $e) {
                $errors[$e->getFieldSlug()] = $e->getErrorMessage();
            }
        }

        if (count($errors) > 1) {
            $errors["status"] = "false";
            throw new ValidationResponseError($errors);
        }
    }

    protected static function registerUser(array $fields): void
    {
        $db = DBCreator::getDatabase();

        if ($db->isRecordExists($fields["email"], $fields["login"])) {
            $errors["status"] = "false";
            $errors["email"] = "Пользователь с таким email или логином уже существует";
            $errors["login"] = "Пользователь с таким email или логином уже существует";
            throw new ValidationResponseError($errors);
        };

        $result = $db->addItem($fields);
        if (!$result) {
            $errors["status"] = "false";
            echo json_encode($errors);
        } else {
            echo json_encode(['status' => 'true']);
        }
    }
}
