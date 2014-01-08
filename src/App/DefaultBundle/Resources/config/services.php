<?php
use Igorw\Silex\ConfigServiceProvider;

return function () use ($app) {
    // Twig
    $app['twig.loader.filesystem']->addPath(__DIR__ . '/../views', 'default');

    // Config
    $app->register(
        new ConfigServiceProvider(
            __DIR__ . '/parameters.yml',
            $app['app.parameters']
        )
    );
};
