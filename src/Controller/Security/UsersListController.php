<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;

class UsersListController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    /**
     * @Route("/users", name="user_list")
     * 
     */

    public function listAction(EntityManagerInterface $manager)
    {
        
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
            
        $users = $manager->getRepository('App:User')->findAll();

        return $this->render('user/list.html.twig', [
            'users' => $users
            ]);
        
    }
}