<?php
return function () use ($app) {
    call_user_func(require_once __DIR__ . '/config.php');

    call_user_func(require_once __DIR__ . '/parameters_dev.php');
    call_user_func(require_once __DIR__ . '/services_dev.php');

    // Bundle configuration(s)
    call_user_func(require_once __DIR__ . '/../../src/App/DefaultBundle/Resources/config/config_dev.php');
};
