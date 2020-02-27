<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\User;
use App\Entity\Comments;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentsController extends AbstractController
{
    /**
     * @Route("/api/addComment", name="addComment")
     */
    public function addComment(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $article_id = $request->request->get('_article_id');
        $user_id = $request->request->get('_user_id');
        $message = $request->request->get('_message');
        $date = $request->request->get('_date');

        $comment = new Comments();

        $article = $this->getDoctrine()->getRepository(Articles::class)->findOneBy(['id'=>$article_id]);
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id'=>$user_id]);

        $comment->setArticle($article);
        $comment->setUserSender($user);
        $comment->setMessage($message);
        $comment->setCreateData(new \DateTime($date));

        $em->persist($comment);
        $em->flush();

        return new Response(sprintf('User %s successfully created', $article->getName()));
    }

    /**
     * @Route("/api/getComment", name="getComment")
     * @param Request $request
     * @return JsonResponse
     */
    public function getComment(Request $request)
    {
        $comment_id = $request->request->get('_comment_id');
        $comment = $this->getDoctrine()->getRepository(Comments::class)->find(['id'=>$comment_id]);

        $user = $comment->getUserSender();
        $articles = $comment->getArticle();
        $message = $comment->getMessage();
        $dateCreate = $comment->getCreateData();

        $response = new JsonResponse(
            [
                'user' => $user->getUsername(),
                'articles' => $articles->getName(),
                'message' => $message,
                'dateCreate' => $dateCreate
            ]
        );

        return $response;
    }

    /**
     * @Route("/api/deleteComment", name="deleteComment")
     */
    public function deleteComment(Request $request)
    {
        $articles_id = $request->request->get('_articles_id');

        $em = $this->getDoctrine()->getManager();

        $article = $this->getDoctrine()->getRepository(Articles::class)->find(['id'=>$articles_id]);

        $article->setName('new name');

        $em->flush();

        return new Response(sprintf('article updated'));
    }
}
