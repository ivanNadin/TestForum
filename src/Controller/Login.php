<?php


namespace App\Controller;

use App\Entity\Users;
use App\Form\MyLoginFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class Login extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @param Request $request
     * @return Response
     */
    public function login(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = new Users();
        $form = $this->createForm(MyLoginFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $em->persist($user);

            $em->flush();
        }

        return $this->render('/base.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

