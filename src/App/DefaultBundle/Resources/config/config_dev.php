<?php
return function () use ($app) {
    call_user_func(require_once __DIR__ . '/config.php');

    call_user_func(require_once __DIR__ . '/parameters_dev.php');
    call_user_func(require_once __DIR__ . '/services_dev.php');
};
