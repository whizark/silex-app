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
                    list($domain, $locale) = explode('.', $file->getFilename());

                    $translator->addResource(
                        'yaml',
                        $file,
                        $locale,
                        $domain
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
                $filesystem->addPath(__DIR__ . '/../views', 'default');

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
