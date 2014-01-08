<?php
use App\Application;
use Symfony\Component\Debug\Debug;

if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || ! in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', 'fe80::1', '::1'])
) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

require_once __DIR__ . '/../vendor/autoload.php';

Debug::enable();

$app = new Application();

call_user_func(require_once __DIR__ . '/../app/config/config_dev.php');

$app->run();
