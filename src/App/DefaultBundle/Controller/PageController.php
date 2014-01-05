<?php
namespace App\DefaultBundle\Controller;

use App\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PageController
 *
 * @package App\DefaultBundle\Controller
 * @author  Whizark
 */
class PageController extends Controller
{
    /**
     * Shows a page
     *
     * @param Application $app An instance of Application class.
     * @param Request $request An instance of Request class.
     * @param string $slug A URI friendly page name to show.
     *
     * @return mixed The response to return.
     */
    public function show(Application $app, Request $request, $slug)
    {
        return $app->render('@default/Page/' . $slug . '.html.twig');
    }
}
