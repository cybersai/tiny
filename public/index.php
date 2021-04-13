<?php

use Dotenv\Dotenv;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;

use function FastRoute\simpleDispatcher;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();


dibi::connect([
    'driver' => $_ENV['DB_DRIVER'],
    'dsn' => $_ENV['DB_DSN'],
    'username' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
]);


$dispatcher = simpleDispatcher(function (RouteCollector $router) {
    include_once __DIR__ . '/../routes/web.php';
});

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($method, $uri);

switch ($routeInfo[0]) {
    case Dispatcher::NOT_FOUND:
        echo json_response(['message' => 'Not Found'], 404);
        break;

    case Dispatcher::METHOD_NOT_ALLOWED:
        echo json_response(['message' => 'Method Not Allowed'], 405);
        break;

    case Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        try {
            echo call_user_func_array($handler, $vars);
        } catch (Exception $e) {
            echo json_response(['message' => 'Internal Server Error'], 500);
        }
        break;
}