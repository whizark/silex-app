<?php
return function () use ($app) {
    $app['app.parameters'] = [
        'app.root_dir' => __DIR__ . '/../..',
    ];
};
