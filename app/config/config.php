<?php
return function () use ($app) {
    // Route
    $app['route_class'] = 'App\\Route';

    // Twig
    $app['twig.path']          = __DIR__ . '/../Resources/views';
    $app['twig.options.debug'] = $app['debug'];

    // Monolog
    $app['monolog.logfile'] = __DIR__ . '/../logs/prod.log';
    $app['monolog.name']    = 'App';

    // Bundle configurations
    call_user_func(require_once __DIR__ . '/../../src/App/DefaultBundle/Resources/config/config.php');
};
