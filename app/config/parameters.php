<?php
return function () use ($app) {
    // Route
    $app['route_class'] = 'App\\Route';

    // Twig
    $app['twig.path']          = __DIR__ . '/../Resources/views';

    // Monolog
    $app['monolog.name']    = 'App';

    // Swift Mailer
    $app['swiftmailer.options'] = [
        'extraparams' => '-f%s',
    ];
};
