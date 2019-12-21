<?php

namespace App\Controller\Task;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class TasksListController extends AbstractController
{
    /**
     * @Route("/tasks/", name="task_list")
     */
    public function listAction(EntityManagerInterface $manager)
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $tasks = $manager->getRepository(Task::class)->findBy(['user' => $user]);
        
        return $this->render('task/list.html.twig', [
            'tasks' => $tasks, 
            'user' => $user
            ]);
    }
}
