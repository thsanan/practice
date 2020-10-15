<?php

use DI\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();

$settings = require __DIR__ . '/../app/settings.php';
$settings($container);

AppFactory::setContainer($container);
$app = AppFactory::create();

$middleware = require __DIR__ . '/../app/middleware.php';
$middleware($app);


$app->get('/', function (ServerRequestInterface $request, ResponseInterface $response, $parameters) {
    $response->getBody()->write('Hello PHP Slim Framework!!');
    return $response;
});

$app->run();