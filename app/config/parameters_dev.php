<?php
return function () use ($app) {
    call_user_func(require_once __DIR__ . '/parameters.php');

    // Twig
    $app['debug']              = true;
    $app['twig.options.debug'] = true;

    // Monolog
    $app['monolog.logfile'] = __DIR__ . '/../logs/dev.log';
};
