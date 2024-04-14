<?php

declare(strict_types=1);

namespace App\Php\Utils\Validation;

use App\php\utils\validation\errors\EmailValidationError;
use App\php\utils\validation\Validation;


class EmailValidation implements Validation
{
    const PATTERN = "/[\\w_.-]+?@\w+?\.\w{2,3}/";

    public static function validate(string $email): bool
    {
        if (!preg_match(self::PATTERN, $email)) {
            throw new EmailValidationError(errorMessage: "Почта должна иметь вид email@example.com", slug: "email");
        }
        return true;
    }
}
