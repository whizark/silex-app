<?php
use Silex\Provider\WebProfilerServiceProvider;
use Igorw\Silex\ConfigServiceProvider;

return function () use ($app) {
    call_user_func(require_once __DIR__ . '/services.php');

    // Silex Web Profiler
    $app->register(new WebProfilerServiceProvider());

    // Config
    $app->register(
        new ConfigServiceProvider(
            __DIR__ . '/parameters_dev.yml',
            $app['app.parameters']
        )
    );
};
