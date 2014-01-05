<?php
return function () use ($app) {
    /**
     * @var \Silex\ControllerCollection $route
     */
    $route     = $app['controllers_factory'];
    $namespace = 'App\\DefaultBundle\\Controller\\';

    // Route: home
    $route->get('/', $namespace . 'PageController::show')
          ->value('slug', 'index')
          ->bind('home');

    // Route: page
    $route->get('/{slug}', $namespace . 'PageController::show')
          ->assert('slug', '.+')
          ->bind('page');

    return $route;
};
