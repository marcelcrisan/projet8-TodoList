<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class TaskControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    /**
     * test de l'ajout d'une tâche
     */
    public function testCreateAction()
    {
        $client = $this->createAuthenticatedClient();
        $crawler = $client->request('GET', '/tasks/create');
        $form = $crawler->selectButton('Ajouter')->form(['task[title]'=>'test titre', 'task[content]'=>'test content']);
        $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('html:contains("test content")')->count());
    }
}