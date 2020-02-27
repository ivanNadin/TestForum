<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/api/addArticles", name="addArticles")
     */
    public function addArticles(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $name = $request->request->get('_name');
        $date = $request->request->get('_date');
        $author = $request->request->get('_author');

        $article = new Articles();
        $article->setName($name);
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username'=>$author]);
        $article->setAuthor($user);

        $article->setDateCreate(new \DateTime($date));

        $em->persist($article);
        $em->flush();

        return new Response(sprintf('User %s successfully created', $article->getName()));
    }

    /**
     * @Route("/api/getArticles", name="getArticles")
     * @param Request $request
     * @return JsonResponse
     */
    public function getArticles(Request $request)
    {
        $author = $request->request->get('_author');

        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username'=>$author]);

        $articles = $user->getArticles()->first()->getName();

        $response = new JsonResponse(['user' => $user->getUsername(),
            'articles' => $articles]);

        return $response;
    }

    /**
     * @Route("/api/editArticles", name="editArticles")
     */
    public function editArticles(Request $request)
    {
        $articles_id = $request->request->get('_articles_id');

        $em = $this->getDoctrine()->getManager();

        $article = $this->getDoctrine()->getRepository(Articles::class)->find(['id'=>$articles_id]);

        $article->setName('new name');

        $em->flush();

        return new Response(sprintf('article updated'));
    }
}
