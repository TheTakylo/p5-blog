<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Framework\Helpers\TextHelper;
use Framework\Http\Response;

class AdminPostsController extends AdminBaseController
{

    /** @var PostRepository $postRepository */
    private $postRepository;

    public function __construct()
    {
        parent::__construct();

        $this->postRepository = $this->getRepository(PostRepository::class);
    }

    public function index(): Response
    {
        $posts = $this->postRepository->findAll();

        return $this->render('admin/posts/index.html.twig', [
            'posts' => $posts
        ]);
    }

    public function add(): Response
    {
        $post = new Post();

        if ($this->request->getMethod() === 'POST') {
            $formData = $this->getRequest()->post;

            $post->setTitle($formData->get('form-title'))
                ->setSlug(TextHelper::slug($formData->get('form-title')))
                ->setContent($formData->get('form-content'));

            if ($this->postRepository->save($post)) {
                $this->flash()->add('success', 'Article ajouté');

                return $this->redirectTo('adminPosts@index');
            } else {
                $this->flash()->add('danger', "Erreur lors de l'ajout de l'article");
            }
        }

        return $this->render('admin/posts/form.html.twig', [
            'post' => $post
        ]);
    }

    public function edit(int $id): Response
    {
        $post = $this->postRepository->findOne(['id' => $id]);

        if (!$post) {
            $this->flash()->add('danger', "L'article n'existe pas");
            $this->redirectTo('adminPosts@index');
        }

        if ($this->request->getMethod() === 'POST') {
            $formData = $this->getRequest()->post;

            if ($this->postRepository->update($formData->get('form-title'), $formData->get('form-content'), $post->getId())) {
                $this->flash()->add('success', 'Article sauvegardé');

                return $this->redirectTo('adminPosts@index');
            } else {
                $this->flash()->add('danger', "Erreur lors de la sauvegarde de l'article");
            }
        }

        return $this->render('admin/posts/form.html.twig', [
            'post' => $post
        ]);
    }

    public function delete(int $id): Response
    {
        $post = $this->postRepository->findOne(['id' => $id]);

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