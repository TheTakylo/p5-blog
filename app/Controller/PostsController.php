<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\PostCommentForm;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use Framework\Controller\AbstractController;
use Framework\Http\Response;

class PostsController extends AbstractController
{
    protected $layout = 'base_layout';

    private $postRepository;

    public function __construct()
    {
        parent::__construct();

        $this->postRepository = $this->getRepository(PostRepository::class);
    }

    public function index(): Response
    {
        $pageNumber = $this->getRequest()->get->get('page') ?? 1;

        $posts = $this->postRepository->findForHomePage($pageNumber);

        return $this->render('posts/index.html.twig', [
            'posts' => $posts
        ]);
    }

    public function show($slug): Response
    {
        $post = $this->postRepository->findOne(['slug' => $slug]);

        if (!$post) {
            die('404'); // TODO
        }

        $commentRepository = $this->getRepository(CommentRepository::class);

        $comment = new Comment();
        $form = new PostCommentForm($comment);

        $form->handleRequest($this->getRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setPostId($post->getId());

            if ($commentRepository->save($comment)) {
                $this->flash()->add('info', "Votre commentaire a bien été ajouté. Il sera vérifié par un administrateur avant d'être visible dans la section commentaires de l'article");
                return $this->redirectTo('posts@show', array('slug' => $post->getSlug()));
            }
        }

        $comments = $commentRepository->findWhere(['post_id' => $post->getId(), 'validated' => 1]);

        return $this->render('posts/show.html.twig', [
            'post'     => $post,
            'comments' => $comments,
            'form'     => $form
        ]);
    }
}