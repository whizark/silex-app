<?php
namespace App;

use Silex\Application as BaseApplication;
use Silex\Application\FormTrait;
use Silex\Application\TranslationTrait;
use Silex\Application\TwigTrait;
use Silex\Application\UrlGeneratorTrait;
use Silex\Application\MonologTrait;
use Silex\Application\SwiftmailerTrait;

/**
 * Class Application
 *
 * @package App\Application
 * @author  Whizark
 */
class Application extends BaseApplication
{
    use FormTrait;
    use TranslationTrait;
    use TwigTrait;
    use UrlGeneratorTrait;
    use MonologTrait;
    use SwiftmailerTrait;
}
