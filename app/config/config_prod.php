<?php
return function () use ($app) {
    call_user_func(require_once __DIR__ . '/config.php');

    call_user_func(require_once __DIR__ . '/services_prod.php');

    // Bundle configuration(s)
    call_user_func(require_once __DIR__ . '/../../src/App/AppBundle/Resources/config/config_prod.php');
};
