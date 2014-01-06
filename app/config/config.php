<?php
return function () use ($app) {
    call_user_func(require_once __DIR__ . '/parameters.php');
    call_user_func(require_once __DIR__ . '/services.php');

    // Bundle configuration(s)
    call_user_func(require_once __DIR__ . '/../../src/App/DefaultBundle/Resources/config/config.php');
};
