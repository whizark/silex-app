<?php
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;

return function () use ($app) {
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

    // Bundle configurations
    call_user_func(require_once __DIR__ . '/../../src/App/DefaultBundle/Resources/config/services.php');
};
