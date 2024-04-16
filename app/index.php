<?php

declare(strict_types=1);
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/src/const/constants.php';

use App\php\Start;
use App\php\utils\validation\errors\aggregatedResponse\ValidationResponseError;

session_start();

try {
    Start::start();
    Start::processRequest();
} catch (ValidationResponseError $e) {
    header("Content-Type: application/json");
    $errorArray = $e->getErrorArray();

    echo json_encode($errorArray);
} catch (\Throwable $e) {
    var_dump(['error' => $e->getCode(), 'message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
}
