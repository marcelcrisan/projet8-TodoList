<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class TaskEditControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    /**
     * test de l'affichage du formulaire de modification d'une tâche
     */
    public function testShowEditTask()
    {
        $client = $this->createAuthenticatedClient();
        $crawler = $client->request('GET', '/tasks/2/edit');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('html:contains("Title")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("Content")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("Modifier")')->count());
    }

    /**
     * test de modification d'une tâche
     */
    public function testEditTask()
    {
        $client = $this->createAuthenticatedClient();
        $crawler = $client->request('GET', '/tasks/2/edit');
        $form = $crawler->selectButton('Modifier')->form(['task[title]'=>'test titre', 'task[content]'=>'test content new']);
        $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('html:contains("test content new")')->count());
    }
}