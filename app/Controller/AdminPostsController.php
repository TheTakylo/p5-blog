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

    public function delete(int $id): Response
    {
        $post = $this->postRepository->findWhere(['id' => $id]);

        if ($post) {
            if ($this->postRepository->remove('id', $id)) {
                $this->flash()->add('success', "L'article a bien été supprimé");
            } else {
                $this->flash()->add('danger', "Erreur lors de la suppression de l'article");
            }
        }

        return $this->redirectTo('adminPosts@index');
    }
}