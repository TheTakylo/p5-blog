<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Framework\Controller\AbstractController;
use Framework\Http\Response;

class PagesController extends AbstractController
{
    protected $layout = 'base_layout';

    public function index(): Response
    {
        $postRepository = $this->getRepository(PostRepository::class);

        $posts = $postRepository->findForHomePage();

        return $this->render('pages/index.html.twig', [
            'posts' => $posts
        ]);
    }
}