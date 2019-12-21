<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class TasksListControllerTest extends WebTestCase
{
    use AuthenticationTrait;
    /**
     * test de l'affichage des tâches
     */
    public function testListAction()
    {
        $client = $this->createAuthenticatedClient('user');
        $crawler = $client->request('GET', '/tasks/');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('html:contains("Marquer comme faite")')->count());
    }
}