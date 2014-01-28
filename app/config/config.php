<?php
use Symfony\Component\HttpFoundation\Response;

return function () use ($app) {
    $app['app.parameters'] = [
        'app.root_dir' => __DIR__ . '/../..',
    ];

    $app->error(
        function (Exception $e, $code) use ($app) {
            if ($app['debug'] || (isset($app['test']) && $app['test'])) {
                return;
            }

            switch ($code) {
                case 404:
                    $message = 'The requested page could not be found.';

                    break;

                default:
                    $message = 'We are sorry, but something went terribly wrong.';

                    break;
            }

            return new Response($message);
        }
    );
};
