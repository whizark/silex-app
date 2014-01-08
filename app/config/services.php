<?php
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollection;
use Igorw\Silex\ConfigServiceProvider;

return function () use ($app) {
    // Routes
    $app['routes'] = $app->extend(
        'routes',
        function (RouteCollection $routes, $app) {
            $loader     = new YamlFileLoader(new FileLocator(__DIR__));
            $collection = $loader->load('routing.yml');
            $routes->addCollection($collection);

            return $routes;
        }
    );

    // Twig
    $app->register(new TwigServiceProvider());
    $app['twig'] = $app->share(
        $app->extend(
            'twig',
            function ($twig, $app) {
                return $twig;
            }
        )
    );

    // UrlGenerator
    $app->register(new UrlGeneratorServiceProvider());

    // Monolog
    $app->register(new MonologServiceProvider());
    $app['monolog'] = $app->share(
        $app->extend(
            'monolog',
            function ($monolog, $app) {
                return $monolog;
            }
        )
    );

    // Swift Mailer
    $app->register(new SwiftmailerServiceProvider());
    $app['swiftmailer.transport.mailinvoker'] = $app->share(
        function ($app) {
            $mailinvoker = new Swift_Transport_SimpleMailInvoker();

            return $mailinvoker;
        }
    );
    $app['swiftmailer.transport'] = $app->share(
        function ($app) {
            $transport = new Swift_Transport_MailTransport(
                $app['swiftmailer.transport.mailinvoker'],
                $app['swiftmailer.transport.eventdispatcher']
            );

            $options = $app['swiftmailer.options'] = array_replace(
                [
                    'extraparams' => '-f%s',
                ],
                $app['swiftmailer.options']
            );

            $transport->setExtraParams($options['extraparams']);

            return $transport;
        }
    );

    // Config
    $app->register(
        new ConfigServiceProvider(
            __DIR__ . '/parameters.yml',
            $app['app.parameters']
        )
    );
};
