<?php
return function () use ($app) {
    $default = call_user_func(require_once __DIR__ . '/../../src/App/DefaultBundle/Resources/config/routing.php');

    $app->mount('/', $default);
};
