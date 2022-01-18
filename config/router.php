<?php

/**
 * Load the routes into the router, this file is included from
 * `htdocs/index.php` during the bootstrapping to prepare for the request to
 * be handled.
 */

declare(strict_types=1);

use FastRoute\RouteCollector;

$router = $router ?? new RouteCollector(
    new \FastRoute\RouteParser\Std(),
    new \FastRoute\DataGenerator\MarkBased()
);

$router->addRoute("GET", "/test", function () {
    // A quick and dirty way to test the router or the request.
    return "Testing response";
});

$router->addRoute("GET", "/", "\Adja20\Controller\Index");
$router->addRoute("GET", "/debug", "\Adja20\Controller\Debug");
$router->addRoute("GET", "/twig", "\Adja20\Controller\TwigView");

$router->addGroup("/session", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Adja20\Controller\Session", "index"]);
    $router->addRoute("GET", "/destroy", ["\Adja20\Controller\Session", "destroy"]);
});

$router->addGroup("/some", function (RouteCollector $router) {
    $router->addRoute("GET", "/where", ["\Adja20\Controller\Sample", "where"]);
});

$router->addGroup("/form", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\Adja20\Controller\Form", "view"]);
    $router->addRoute("POST", "/process", ["\Adja20\Controller\Form", "process"]);
});

$router->addGroup("/dice", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Adja20\Controller\Dice", "view"]);
    $router->addRoute("POST", "/process", ["\Adja20\Controller\Dice", "process"]);
});

$router->addGroup("/game21", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Adja20\Controller\Game21Controller", "view"]);
    $router->addRoute("GET", "/destroy", ["\Adja20\Controller\Game21Controller", "destroy"]);
    $router->addRoute("POST", "/process", ["\Adja20\Controller\Game21Controller", "process"]);
});

$router->addGroup("/game21computer", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Adja20\Controller\Game21ComputerController", "view"]);
    $router->addRoute("GET", "/destroy", ["\Adja20\Controller\Game21ComputerController", "destroy"]);
    $router->addRoute("GET", "/newround", ["\Adja20\Controller\Game21ComputerController", "newround"]);
    $router->addRoute("POST", "/process", ["\Adja20\Controller\Game21ComputerController", "process"]);
});
$router->addGroup("/yatzy", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Adja20\Controller\YatzyController", "view"]);
    $router->addRoute("GET", "/destroy", ["\Adja20\Controller\YatzyController", "destroy"]);
    $router->addRoute("POST", "/process", ["\Adja20\Controller\YatzyController", "process"]);
});
