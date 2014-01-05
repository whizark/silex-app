<?php
return function () use ($app) {
    // Route
    $app['route_class'] = 'App\\Route';

    // Twig
    $app['twig.path']   = __DIR__ . '/../Resources/views';

    // Bundle configurations
    call_user_func(require_once __DIR__ . '/../../src/App/DefaultBundle/Resources/config/config.php');
};
