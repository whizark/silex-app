<?php
return function () use ($app) {
    $app['route_class'] = 'App\\Route';

    call_user_func(require_once __DIR__ . '/../../src/App/DefaultBundle/Resources/config/config.php');
};
