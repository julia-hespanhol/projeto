<?php

declare(strict_types=1);

namespace Glance\Onboarding\HelloWorld\Infrastructure\Web;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class HelloWorldController
{
    public function hello(Request $request, Response $response): Response
    {
        $response->getBody()->write("Hello World (and welcome to Glance ✨)");
        return $response->withHeader("content-type", "text/html");
    }

    public function memberList(Request $request, Response $response): Response
    {
        $response->getBody()->write()
    }
}
