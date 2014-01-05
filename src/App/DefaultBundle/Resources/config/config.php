<?php
return function () use ($app) {
    // Twig
    $app['twig.loader.filesystem']->addPath(__DIR__ . '/../views', 'default');

    // Service configuration
    call_user_func(require_once __DIR__ . '/services.php');
};
