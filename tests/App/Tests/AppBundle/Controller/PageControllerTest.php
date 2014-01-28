<?php
namespace App\Tests\AppBundle\Controller;

use App\Tests\WebTestCase;

/**
 * Class PageControllerTest
 *
 * @package App\Tests\AppBundle\Controller
 * @author  Whizark
 */
class PageControllerTest extends WebTestCase
{
    public function testRequestForIndexPageShouldShowTheDefaultPage() {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertCount(1, $crawler->filter('title:contains("Application")'));
    }

    public function testRequestWithSlugShouldShowThePage() {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/index');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertCount(1, $crawler->filter('title:contains("Application")'));
    }

    /**
     * @expectedException \Twig_Error_Loader
     */
    public function testRequestForNonExistingPageShouldThrowTwigErrorLoaderException()
    {
        $client = $this->createClient();

        $client->request('GET', '/404-page-not-found');
    }
}
