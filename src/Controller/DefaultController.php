<?php

namespace App\Controller;

use App\Entity\Articles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DefaultController extends AbstractController
{
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();

        $username = $request->request->get('_username');
        $email = $request->request->get('_email');
        $password = $request->request->get('_password');

        $user = new User($username);
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setEmail($email);

        $em->persist($user);
        $em->flush();

        return new Response(sprintf('User %s successfully created', $user->getUsername()));
    }

    public function addArticles(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $name = $request->request->get('_name');
        $date = $request->request->get('_date');
        $author = $request->request->get('_author');

        $article = new Articles();
        $article->setName($name);
        $article->setAuthor($author);

        $article->setDateCreate(new \DateTime($date));

        $em->persist($article);
        $em->flush();

        return new Response(sprintf('User %s successfully created', $article->getName()));
    }

    public function api()
    {
        return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
    }
}
