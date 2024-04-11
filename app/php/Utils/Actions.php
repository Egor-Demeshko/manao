<?php

declare(strict_types=1);

namespace App\Php\Utils;


class Actions
{
    private static array $actions = [];

    public static function addAction(string $actionId, callable $action): void
    {
        if (isset($actions[$actionId])) {
            self::$actions[$actionId][] = $action;
        } else {
            self::$actions[$actionId] = [$action];
        }
    }

    public static function callAction(string $actionName, array $args): void
    {
        $actions = self::$actions[$actionName];
        foreach ($actions as $action) {

            call_user_func_array($action, $args);
        }
    }
}
