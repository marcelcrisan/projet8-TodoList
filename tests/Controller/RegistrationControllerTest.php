<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    /**
     * test de l'ajout d'un utilisateur
     */
    public function testCreateAction()
    {
        $client = self::createClient();
        $crawler = $client->request('GET', '/users/create');
        $form = $crawler->selectButton('Ajouter')->form([
            'user[username]'=>'usertest1',
            'user[password][first]'=>'computer',
            'user[password][second]'=>'computer',
            'user[email]'=>'usertest1@symfony.com',
            'user[roles]'=>'ROLE_USER']);

        $client->submit($form);
        $crawler= $client->followRedirect();
        $this->assertSame(302, $client->getResponse()->getStatusCode());
        $crawler= $client->followRedirect();
        $this->assertEquals(1, $crawler->filter('html:contains("utilisateur a bien été ajouté.")')->count());
    }  

}