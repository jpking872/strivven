<?php

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/login', 'App\Controllers\LoginController:login')
    ->setName('login');

    /*$app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });*/
};
