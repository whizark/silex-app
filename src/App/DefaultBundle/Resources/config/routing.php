<?php
return function () use ($app) {
    $route = $app['controllers_factory'];

    return $route;
};
