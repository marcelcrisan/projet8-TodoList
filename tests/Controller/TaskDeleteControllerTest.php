<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class TaskDeleteControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    /**
     * test de la suppression d'une tâche
     */
    public function testDeleteTask()
    {
        $client = $this->createAuthenticatedClient();
        $crawler = $client->request('GET', '/tasks/');
        $form = $crawler->selectButton('Supprimer')->eq(2)->form();
        $client->submit($form);
        $crawler= $client->followRedirect();
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertNotEquals(0, $crawler->filter('html button:contains("Supprimer")')->count());
    }
}