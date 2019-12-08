<?php

use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true
    ]));

    $routes->applyMiddleware('csrf');

    $URL = $_SERVER["REQUEST_URI"];
    if (strpos($URL, "?") > -1) {
        $URL = substr($URL, 0, strpos($URL, "?"));
    }
    $router = explode("/", $URL);
    $controller = "";
    $action = "";
    if (count($router) < 3) {
        $action = "index";
    } else {
        $action = $router[2];
        unset($router[2]);
    }
    if (count($router) < 2 || trim($router[1]) === "") {
        $controller = "Home";
    } else {
        $controller = $router[1];
        unset($router[1]);
    }
    $routes->connect('*', ['controller' => $controller, 'action' => $action]);

    $routes->fallbacks(DashedRoute::class);
});
