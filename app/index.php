<?php

declare(strict_types=1);
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/src/const/constants.php';

use App\php\Start;

// Включить вывод ошибок в браузере
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    Start::start();
    Start::processRequest();
} catch (\Throwable $e) {

    var_dump(['error' => $e->getCode(), 'message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
}
