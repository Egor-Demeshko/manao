<?php

declare(strict_types=1);


namespace App\php\utils\validation\errors\aggregatedResponse;


class ValidationResponseError extends \Error
{

    public function __construct(public array $errorArray)
    {
    }

    public function setErrorArray(array $array): void
    {
        $this->errorArray = $array;
    }

    public function getErrorArray(): array
    {
        return $this->errorArray;
    }
}
