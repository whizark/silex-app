<?php
use App\Application;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application();

call_user_func(require_once __DIR__ . '/../app/config/config_prod.php');

$app->run();
