<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserEditControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    /**
     * test de modification d'un utilisateur
     */
    public function testEditAction()
    {
        $client = $this->createAuthenticatedClient('user1');
        $crawler = $client->request('GET', '/users/3/edit');
        $form = $crawler->selectButton('Modifier')->form([
            'user[username]'=>'user2',
            'user[password][first]'=>'computer',
            'user[password][second]'=>'computer',
            'user[email]'=>'usertest2@symfony.com',
            'user[roles]'=>'ROLE_USER']);

        $client->submit($form);
        $crawler= $client->followRedirect();
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(0, $crawler->filter('html:contains("utilisateur a bien été modifié.")')->count());
    }  

}