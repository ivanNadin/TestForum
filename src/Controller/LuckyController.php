<?php


namespace App\Controller;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    /**
     * @Route("/number", name="number")
     */
    public function number(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new Users();
        $user->setUserName('user_test');
        $user->setEmail('test@mail');
        $user->setPassword('pass');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$user->getId());
    }

}
