<?php
return function () use ($app) {
    $app['twig.loader.filesystem']->addPath(__DIR__ . '/../views', 'default');
};
