<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserDeleteControllerTest extends WebTestCase
{
    use AuthenticationTrait;

    /**
     * test de supprimer d'un utilisateur non enregistré
     */
    public function testDeleteAction()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/users/5/delete');
        $this->assertSame(404, $client->getResponse()->getStatusCode());
    }

    /**
     * test deny access pour supprimer si n'est pas admin
     */
    public function testDeleteActionDeny()
    {
        $client = $this->createAuthenticatedClient('user');
        $client->request('GET', '/users/2/delete');
        $this->assertSame(403, $client->getResponse()->getStatusCode());
    }
}
