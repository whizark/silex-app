<?php
use Igorw\Silex\ConfigServiceProvider;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Finder\Finder;

return function () use ($app) {
    // Translation
    $app['translator'] = $app->share(
        $app->extend(
            'translator',
            function ($translator, $app) {
                $translator->addLoader('yaml', new YamlFileLoader());

                $location = __DIR__ . '/../translations';
                $finder   = new Finder();

                $finder->files()
                       ->ignoreVCS(true)
                       ->name('*.yml')
                       ->in($location);

                foreach ($finder as $file) {
                    preg_match('/^(?<domain>.*?)\.?(?<locale>[^.]*)?$/u', $file->getBasename('.yml'), $matches);

                    $translator->addResource(
                        'yaml',
                        $file,
                        $matches['locale'],
                        ($matches['domain'] !== '') ? $matches['domain'] : null
                    );
                }

                return $translator;
            }
        )
    );

    // Twig
    $app['twig.loader.filesystem'] = $app->share(
        $app->extend(
            'twig.loader.filesystem',
            function($filesystem, $app) {
                $filesystem->addPath(__DIR__ . '/../views', 'app');

                return $filesystem;
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
