<?php
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Routing\Loader\YamlFileLoader as RoutingYamlFileLoader;
use Symfony\Component\Translation\Loader\YamlFileLoader as TranslationYamlFileLoader;
use Igorw\Silex\ConfigServiceProvider;

return function () use ($app) {
    // Routes
    $app['routes'] = $app->share(
        $app->extend(
            'routes',
            function ($routes, $app) {
                $loader      = new RoutingYamlFileLoader(new FileLocator(__DIR__));
                $environment = $app['debug'] ? 'dev' : 'prod';
                $collection  = $loader->load('routing_' . $environment . '.yml');
                $routes->addCollection($collection);

                return $routes;
            }
        )
    );

    // Doctrine
    $app->register(new DoctrineServiceProvider());

    // Form
    $app->register(new FormServiceProvider());

    // Session
    $app->register(new SessionServiceProvider());

    // Translation
    $app->register(new TranslationServiceProvider());
    $app['translator'] = $app->share(
        $app->extend(
            'translator',
            function ($translator, $app) {
                $translator->addLoader('yaml', new TranslationYamlFileLoader());

                $location = __DIR__ . '/../Resources/translations';
                $finder   = new Finder();

                $finder->files()
                       ->ignoreVCS(true)
                       ->name('*.yml')
                       ->in($location);

                foreach ($finder as $file) {
                    list($locale) = explode('.', $file->getFilename());

                    $translator->addResource(
                        'yaml',
                        $file,
                        $locale
                    );
                }

                return $translator;
            }
        )
    );

    // Twig
    $app->register(new TwigServiceProvider());
    $app['twig'] = $app->share(
        $app->extend(
            'twig',
            function ($twig, $app) {
                $twig->addFunction(
                    new Twig_SimpleFunction('asset', function ($asset) use ($app) {
                        return sprintf('%s/%s', $app['request']->getBasePath(), ltrim($asset, '/'));
                    })
                );

                return $twig;
            }
        )
    );

    // UrlGenerator
    $app->register(new UrlGeneratorServiceProvider());

    // Monolog
    $app->register(new MonologServiceProvider());

    // ServiceController
    $app->register(new ServiceControllerServiceProvider());

    // Swift Mailer
    $app->register(new SwiftmailerServiceProvider());
    $app['swiftmailer.transport'] = $app->share(
        $app->extend(
            'swiftmailer.transport',
            function ($transport, $app) {
                $app['swiftmailer.transport.mailinvoker'] = $app->share(
                    function ($app) {
                        $mailinvoker = new Swift_Transport_SimpleMailInvoker();

                        return $mailinvoker;
                    }
                );

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
        )
    );

    // Config
    $app->register(
        new ConfigServiceProvider(
            __DIR__ . '/parameters.yml',
            $app['app.parameters']
        )
    );
};
