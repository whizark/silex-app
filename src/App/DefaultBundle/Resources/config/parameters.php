<?php
return function () use ($app) {
    // Twig
    $app['twig.loader.filesystem']->addPath(__DIR__ . '/../views', 'default');
};
