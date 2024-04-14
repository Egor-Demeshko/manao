<?php

declare(strict_types=1);

namespace App\Php\Utils\Validation;

use App\php\utils\validation\errors\PasswordValidationError;
use App\php\utils\validation\Validation;


class PasswordValidation implements Validation
{
    public static function validate(string $passwordOne, string $passwordTwo = ''): bool
    {
        if ($passwordOne !== $passwordTwo) {
            throw new PasswordValidationError(errorMessage: "Пароли не равны", slug: "password");
        }
        return true;
    }
}
