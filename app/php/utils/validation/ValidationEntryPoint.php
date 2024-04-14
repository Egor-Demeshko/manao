<?php

declare(strict_types=1);

namespace App\Php\Utils\Validation;

use App\php\utils\validation\Validation;

class ValidationEntryPoint
{
    const VALIDATION_ROUTE = "\\App\\php\\utils\\validation\\";

    public static function generateValidationRoutes(string $value, string $field = '', string $addString = ''): bool
    {

        $filedWithCapital = ucfirst($field);
        $callback = self::VALIDATION_ROUTE . "$filedWithCapital" . "Validation::validate";

        return call_user_func($callback, $value, $addString);
    }
}
