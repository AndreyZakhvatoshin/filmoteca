<?php

use Aura\SqlQuery\QueryFactory;
use DI\ContainerBuilder;
use League\Plates\Engine;
use FastRoute\RouteCollector;

$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions([
    Engine::class => function () {
        return new Engine(('../src/views'));
    },
    PDO::class => function () {
        return new PDO("mysql:host=localhost;dbname=test", "root", "password");
    },
    QueryFactory::class => function () {
        return new QueryFactory('mysql');
    }
]);

$container = $containerBuilder->build();

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', ['App\Controllers\FilmsController', 'index']);
    $r->addRoute('GET', '/films/add', ['App\Controllers\FilmsController', 'add']);
    $r->addRoute('GET', '/films/{id}', ['App\Controllers\FilmsController', 'show']);
    $r->addRoute('GET', '/films/{id}/edit', ['App\Controllers\FilmsController', 'edit']);
    $r->addRoute('GET', '/category/{id}', ['App\Controllers\FilmsController', 'showCategory']);
    $r->addRoute('GET', '/films/{id}/delete', ['App\Controllers\FilmsController', 'delete']);

    $r->addRoute('POST', '/films/store', ['App\Controllers\FilmsController', 'store']);
    $r->addRoute('POST', '/films/{id}/update', ['App\Controllers\FilmsController', 'update']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $container->call($handler, $vars);
        break;
}
