<?php

declare(strict_types=1);

namespace App\Php\Utils\Validation\Errors;


interface ValidationError
{

    public function getErrorMessage(): string;

    public function getFieldSlug(): string;
}
