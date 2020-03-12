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
        $data = json_decode($request->getContent(),true);
        $articleId = $data['articleId'];
        $userId = $data['userId'];
        $message = $data['message'];
        $em = $this->getDoctrine()->getManager();



        $comment = new Comments();

        $article = $this->getDoctrine()->getRepository(Articles::class)->findOneBy(['id'=>$articleId]);
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id'=>$userId]);

        $comment->setArticle($article);
        $comment->setUserSender($user);
        $comment->setMessage($message);
        $comment->setCreateData(new \DateTime('Now'));

        $em->persist($comment);
        $em->flush();

        return new Response();
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

        return new JsonResponse(
            [
                'user' => $user->getUsername(),
                'articles' => $articles->getName(),
                'message' => $message,
                'dateCreate' => $dateCreate
            ]
        );
    }

    /**
     * @Route("/api/getComments", name="getComments")
     * @param Request $request
     * @return JsonResponse
     */
    public function getCommentsOfArticle(Request $request)
    {
        $data = json_decode($request->getContent(),true);
        $article_id = json_decode($data['articleId']);
        $article = $this->getDoctrine()->getRepository(Articles::class)->find(['id'=>$article_id]);

        $message = $article->getMessages();
        $arr = [];

        $i = 0;
        foreach ($message as $m)
        {
            $arr[$i] = [
                "message" => $m->getMessage(),

                "user" => $m->getUserSender()->getUsername(),

                "createData" => $m->getCreateData()->format('Y-m-d H:i')
            ];

            $i++;
        }

        return new JsonResponse($arr);
    }

    /**
     * @Route("/api/deleteComment", name="deleteComment")
     */
    public function deleteComment(Request $request)
    {
        $comment_id = $request->request->get('_comment_id');

        $em = $this->getDoctrine()->getManager();

        $comment = $this->getDoctrine()->getRepository(Comments::class)->find(['id'=>$comment_id]);

        $em->remove($comment);
        $em->flush();

        return new Response(sprintf('comment deleted'));
    }
}
