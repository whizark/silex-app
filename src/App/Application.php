<?php
namespace App;

use Silex\Application as BaseApplication;
use Silex\Application\TwigTrait;
use Silex\Application\UrlGeneratorTrait;

/**
 * Class Application
 *
 * @package App\Application
 * @author  Whizark
 */
class Application extends BaseApplication
{
    use TwigTrait;
    use UrlGeneratorTrait;
}
