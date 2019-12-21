<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    use AuthenticationTrait;
    private $client;
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');
        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    public function testIndexAction()
    {

        $client = $this->createAuthenticatedClient();
        $crawler = $client->request('GET', '/');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('html:contains("Consulter la liste des tâches terminées")')->count());
    }
    public function testNotConnectedIndexAction()
    {
        $client = self::createClient();
        $client->request('GET', '/');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}
