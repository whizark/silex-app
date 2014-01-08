<?php
use Igorw\Silex\ConfigServiceProvider;

return function () use ($app) {
    // Twig
    $app['twig.loader.filesystem'] = $app->share(
        $app->extend(
            'twig.loader.filesystem',
            function($filesystem, $app) {
                $filesystem->addPath(__DIR__ . '/../views', 'default');

                return $filesystem;
            }
        )
    );

    // Config
    $app->register(
        new ConfigServiceProvider(
            __DIR__ . '/parameters.yml',
            $app['app.parameters']
        )
    );
};
