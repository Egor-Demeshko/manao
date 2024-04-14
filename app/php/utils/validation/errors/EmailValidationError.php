<?php


declare(strict_types=1);

namespace App\Php\Utils\Validation\Errors;

use Error;
use App\php\utils\validation\errors\ValidationError;

class EmailValidationError extends Error implements ValidationError
{

    public function __construct(private string $errorMessage, private string $slug)
    {
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function getFieldSlug(): string
    {
        return $this->slug;
    }
}
