<?php

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', 'App\Controllers\LoginController:render')->setName('index');

    $app->post('/login', 'App\Controllers\LoginController:login')
    ->setName('login');

    $app->get('/logout', 'App\Controllers\LoginController:logout')
    ->setName('logout');

    $app->get('/answer', 'App\Controllers\QuestionController:answer')
    ->setName('answer');

    $app->get('/score', 'App\Controllers\QuestionController:score')
    ->setName('score');

    /*$app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });*/
};
