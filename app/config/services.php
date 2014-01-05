<?php
use Silex\Provider\TwigServiceProvider;

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

    // Bundle configurations
    call_user_func(require_once __DIR__ . '/../../src/App/DefaultBundle/Resources/config/services.php');
};
