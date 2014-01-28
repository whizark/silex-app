<?php
namespace App\Tests;

use App\Application;
use Symfony\Component\Debug\Debug;
use Silex\WebTestCase as BaseWebTestCase;

/**
 * Class WebTestCase
 *
 * @package App\Tests\WebTestCase
 * @author  Whizark
 */
class WebTestCase extends BaseWebTestCase
{
    /**
     * {@inheritDoc}
     */
    public function createApplication()
    {
        Debug::enable();

        $app         = new Application();
        $app['test'] = true;

        call_user_func(require __DIR__ . '/../../../app/config/config_test.php');

        $app['exception_handler']->disable();

        return $app;
    }
}
