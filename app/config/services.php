<?php
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;

return function () use ($app) {
    // Twig
    $app->register(new TwigServiceProvider());
    $app['twig'] = $app->share(
        $app->extend(
            'twig',
            function ($twig, $app) {
                return $twig;
            }
        )
    );

    // UrlGenerator
    $app->register(new UrlGeneratorServiceProvider());

    // Monolog
    $app->register(new MonologServiceProvider());
    $app['monolog'] = $app->share(
        $app->extend(
            'monolog',
            function ($monolog, $app) {
                return $monolog;
            }
        )
    );

    // Bundle configurations
    call_user_func(require_once __DIR__ . '/../../src/App/DefaultBundle/Resources/config/services.php');
};
