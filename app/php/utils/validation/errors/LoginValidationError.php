<?php


declare(strict_types=1);

namespace App\Php\Utils\Validation\Errors;

use Error;
use App\Php\Utils\Validation\Errors\ValidationError;

class LoginValidationError extends Error implements ValidationError
{

    public function __construct(private string $message, private string $slug)
    {
    }

    public function getErrorMessage(): string
    {
        return $this->message;
    }

    public function getFieldSlug(): string
    {
        return $this->slug;
    }
}
