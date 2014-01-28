<?php
return function () use ($app) {
    call_user_func(require __DIR__ . '/config.php');

    call_user_func(require __DIR__ . '/services_test.php');
};
