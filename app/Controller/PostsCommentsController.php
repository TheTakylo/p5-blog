<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use Framework\Controller\AbstractController;
use Framework\Http\Response;

class PostsCommentsController extends AbstractController
{
    public function add($post_id): Response
    {
        $postRepository = $this->getRepository(PostRepository::class);

        $post = $postRepository->findOne(['id' => $post_id]);

        if (!$post) {
            return $this->redirectTo('posts@index');
        }

        $commentRepository = $this->getRepository(CommentRepository::class);

        $comment = new Comment();

        $formData = $this->request->post;

        $comment->setPostId($post->getId())
            ->setName($formData->get('form-name'))
            ->setEmail($formData->get('form-email'))
            ->setContent($formData->get('form-content'));

        if ($commentRepository->save($comment)) {
            $this->flash()->add('info', "Votre commentaire a bien été ajouté. Il sera vérifié par un administrateur avant d'être visible dans la section commentaires de l'article");
        } else {
            $this->flash()->add('danger', "Erreur lors de l'ajout de votre commentaire");
        }

        return $this->redirectTo('posts@show', ['slug' => $post->getSlug()]);
    }
}