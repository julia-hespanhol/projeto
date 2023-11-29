<?php

declare(strict_types=1);

namespace Glance\Onboarding\HelloWorld\Infrastructure\Web;

use Slim\App;

class HelloWorldRoutes
{
    public static function addRoutes(App $app): void
    {
        $app->get("/hello-world", [HelloWorldController::class, "hello"]);
    }
}
