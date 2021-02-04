<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use Framework\Http\Response;

class AdminController extends AdminBaseController
{
    public function index(): Response
    {
        $posts = $this->getRepository(PostRepository::class)->findAll();

        $commentsRepository = $this->getRepository(CommentRepository::class);

        $comments = $commentsRepository->findWhere(['validated' => 1]);
        $commentsToValidate = $commentsRepository->findWhere(['validated' => 0]);

        return $this->render('admin/index.html.twig', [
            'postsCounts'              => count($posts),
            'commentsToValidateCounts' => count($commentsToValidate),
            'commentsCounts'           => count($comments)
        ]);
    }
}