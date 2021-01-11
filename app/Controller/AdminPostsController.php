<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Framework\Http\Response;

class AdminPostsController extends AdminBaseController
{

    /** @var PostRepository $postRepository */
    private $postRepository;

    public function __construct()
    {
        $this->postRepository = $this->getRepository(PostRepository::class);
    }

    public function index(): Response
    {
        $posts = $this->postRepository->findAll();

        return $this->render('admin/posts/index.html.twig', [
            'posts' => $posts
        ]);
    }

}