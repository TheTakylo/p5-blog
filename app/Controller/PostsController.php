<?php

namespace App\Controller;

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

    public function show($slug): Response
    {
        $post = $this->postRepository->findOne(['slug' => $slug]);

        if (!$post) {
            die();
        }

        return $this->render('posts/show.php', [
            'post' => $post
        ]);
    }
}