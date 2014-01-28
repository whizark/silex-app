<?php
use Igorw\Silex\ConfigServiceProvider;

return function () use ($app) {
    call_user_func(require __DIR__ . '/services.php');

    // Config
    $app->register(
        new ConfigServiceProvider(
            __DIR__ . '/parameters_test.yml',
            $app['app.parameters']
        )
    );
};
