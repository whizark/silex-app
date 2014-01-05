<?php
return function () use ($app) {
    // Route
    $app['route_class'] = 'App\\Route';

    // Twig
    $app['twig.path']          = __DIR__ . '/../Resources/views';
    $app['twig.options.debug'] = $app['debug'];
    $app['twig.options.cache'] = __DIR__ . '../cache/twig';

    // Monolog
    $app['monolog.logfile'] = __DIR__ . '/../logs/prod.log';
    $app['monolog.name']    = 'App';

    // Swift Mailer
    $app['swiftmailer.options'] = [
        'extraparams' => '-f%s',
    ];
};
