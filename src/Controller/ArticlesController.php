<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Doctrine\Common\Annotations\AnnotationReader;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/api/addArticle", name="addArticle")
     */
    public function addArticle(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $name = $request->request->get('_name');
        $author = $request->request->get('_author');

        $article = new Articles();
        $article->setName($name);
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username'=>$author]);
        $article->setAuthor($user);

        $article->setDateCreate(new \DateTime('Now'));

        $em->persist($article);
        $em->flush();

        return new Response(sprintf('User %s successfully created', $article->getName()));
    }

    /**
     * @Route("/api/getArticle", name="getArticle")
     * @param Request $request
     * @return JsonResponse
     */
    public function getArticle(Request $request)
    {
        $author = $request->request->get('_author');

        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username'=>$author]);

        $articles = $user->getArticles()->first()->getName();

        return new JsonResponse(['user' => $user->getUsername(),
            'articles' => $articles]);
    }

    /**
     * @Route("/api/editArticle", name="editArticle")
     */
    public function editArticle(Request $request)
    {
        $articles_id = $request->request->get('_articles_id');

        $em = $this->getDoctrine()->getManager();

        $article = $this->getDoctrine()->getRepository(Articles::class)->find(['id'=>$articles_id]);

        $article->setName('new name');

        $em->flush();

        return new Response(sprintf('article updated'));
    }

    /**
     * @Route("/api/getArticles", name="getArticles")
     * @param Request $request
     * @return Response
     * @throws \Doctrine\Common\Annotations\AnnotationException
     */
    public function getArticles(Request $request)
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer(new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader())))];

        $serializer = new Serializer($normalizers, $encoders);

        $articles = $this->getDoctrine()->getRepository(Articles::class)->findByDate();

        $serializeData = $serializer->serialize($articles, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);

        $response = new Response($serializeData);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
