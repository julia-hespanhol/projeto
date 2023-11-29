<?php

require_once __DIR__ . '/vendor/autoload.php';

use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Glance\Onboarding\HelloWorld\Infrastructure\Web\HelloWorldRoutes;
use Glance\Onboarding\Collaboration\Infrastructure\Web\CollaborationRoutes;
use DI\ContainerBuilder;
use Slim\Exception\HttpNotFoundException;
use Slim\Factory\AppFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Glance\Onboarding\Collaboration\Dependencies as CollaborationDependencies;

Dotenv\Dotenv::createUnsafeImmutable(__DIR__)->load();

$containerBuilder = new ContainerBuilder();

$baseDefinitions = [
    Connection::class => function () {
        $config = new Configuration();
        $connectionParams = [
            'dbname'   => getenv('DB_NAME'),
            'user'     => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'host'     => getenv('DB_HOST'),
            'driver'   => getenv('PHP_PDO_DRIVER'),
        ];

        return DriverManager::getConnection($connectionParams, $config);
    },
];

$containerBuilder->addDefinitions(
    array_merge(
        $baseDefinitions,
        CollaborationDependencies::definitions()
    )
);

$container = $containerBuilder->build();

$app = AppFactory::createFromContainer($container);

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$errorMiddleware->setDefaultErrorHandler(function ($request, $exception) use ($app) {
    $response = $app->getResponseFactory()->createResponse();
    $code = $exception->getCode() ? $exception->getCode() : 400;
    $response->getBody()->write(json_encode([
        'status' => 'error',
        'code' => $code,
        'message' => $exception->getMessage(),
        'timestamp' => date('Y-m-d H:i:s'),
    ]));

    return $response->withHeader('Content-Type', 'application/json')->withStatus($code);
});

$app->setBasePath('/api');


HelloWorldRoutes::addRoutes($app);
CollaborationRoutes::addRoutes($app);

$app->any('/{routes:.+}', function (Request $request, Response $response) {
    throw new HttpNotFoundException($request, "Route not found.");
});

$app->run();
