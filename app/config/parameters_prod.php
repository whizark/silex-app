<?php
return function () use ($app) {
    call_user_func(require_once __DIR__ . '/parameters.php');

    // Twig
    $app['twig.options.cache'] = __DIR__ . '../cache/twig';

    // Monolog
    $app['monolog.logfile'] = __DIR__ . '/../logs/prod.log';
};
