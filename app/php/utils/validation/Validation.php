<?php

declare(strict_types=1);

namespace App\Php\Utils\Validation;


interface Validation
{
    /**@throws ValidationError */
    public static function validate(string $value): bool;
}
