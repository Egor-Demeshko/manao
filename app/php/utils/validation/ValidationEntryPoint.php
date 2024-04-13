<?php

declare(strict_types=1);

namespace App\Php\Utils\Validation;

use App\php\utils\validation\Validation;

class ValidationEntryPoint implements Validation
{

    public static function validate(string $value, string $field = ''): bool
    {
        define("VALIDATION_ROUTE", "\\App\\php\\utils\\validation\\");
        $filedWithCapital = ucfirst($field);

        return call_user_func(VALIDATION_ROUTE . "$filedWithCapital" . "Validation::validate", $value);
    }
}
