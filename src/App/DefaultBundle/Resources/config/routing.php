<?php
return function () use ($app) {
    /**
     * @var \Silex\ControllerCollection $route
     */
    $route = $app['controllers_factory'];

    return $route;
};
