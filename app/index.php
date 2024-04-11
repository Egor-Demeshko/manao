<?php

declare(strict_types=1);
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/src/const/constants.php';

use App\php\Start;
use App\php\Utils\Actions;

try {
    Start::start();
    Start::processRequest();
} catch (\Throwable $e) {

    var_dump(['error' => $e->getCode(), 'message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
}
