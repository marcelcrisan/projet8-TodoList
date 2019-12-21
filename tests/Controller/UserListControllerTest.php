<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserListControllerTest extends WebTestCase
{
    use AuthenticationTrait;
    /**
     * test demande de conneexion pour l'affichage des utilisateurs
     */
    public function testLogShowUsers()
    {
        $client = self::createClient();
        $client->request('GET', '/users');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
    /**
     * test de l'affichage des utilisateurs
     */
    public function testShowUsers()
    {
        $client = $this->createAuthenticatedClient();
        $crawler = $client->request('GET', '/users');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('html:contains("Liste des utilisateurs")')->count());
    }
    /**
     * test voters pour users list
     */

    public function testDenyAccess()
    {
        $client = $this->createAuthenticatedClient('user');
        $client->request('GET', '/users');
        $this->assertEquals(403, $client->getResponse()->getStatusCode());
    }
}