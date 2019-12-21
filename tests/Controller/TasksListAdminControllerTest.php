<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class TasksListAdminControllerTest extends WebTestCase
{
    use AuthenticationTrait;
    /**
     * test de l'affichage des tâches
     */
    public function testListAdmin()
    {
        $client = $this->createAuthenticatedClient();
        $crawler = $client->request('GET', '/tasks/admin');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('html:contains("Supprimer")')->count());
    }

    /**
     * test deny access de l'affichage des tâches
     */
    public function testListAdminDeny()
    {
        $client = $this->createAuthenticatedClient('user');
        $client->request('GET', '/tasks/admin');
        $this->assertSame(403, $client->getResponse()->getStatusCode());
    }
}