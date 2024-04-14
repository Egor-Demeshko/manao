<?php

declare(strict_types=1);

namespace App\Php\Utils\Validation;

use App\php\utils\validation\errors\LoginValidationError;
use App\php\utils\validation\Validation;


class LoginValidation implements Validation
{
    public static function validate(string $login): bool
    {
        if (strlen($login) < 3) {
            throw new LoginValidationError(errorMessage: "Количество символов в логине должно быть больше 3", slug: "login");
        }

        return true;
    }
}
