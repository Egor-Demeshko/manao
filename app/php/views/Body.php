<?php

declare(strict_types=1);

namespace app\php\views;

class Body
{
    const START_BODY = "startBody";
    const END_BODY = "endBody";

    public static function startBody(): void
    {
        echo '<body>';
    }

    public static function endBody(): void
    {
        echo '</body>';
    }
}
