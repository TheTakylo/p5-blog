<?php

namespace App\Controller;

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
            die();
        }

        $commentRepository = $this->getRepository(CommentRepository::class);
        $comments = $commentRepository->findWhere(['post_id' => $post->getId(), 'validated' => 0]);

        return $this->render('posts/show.html.twig', [
            'post'     => $post,
            'comments' => $comments
        ]);
    }
}