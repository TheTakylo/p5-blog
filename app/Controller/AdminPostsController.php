<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostDeleteForm;
use App\Form\PostForm;
use App\Repository\PostRepository;
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
        $posts = $this->postRepository->findWhere(array(), "ORDER BY id DESC");

        return $this->render('admin/posts/index.html.twig', [
            'posts' => $posts
        ]);
    }

    public function add(): Response
    {
        $post = new Post();
        $form = new PostForm($post);

        $form->handleRequest($this->getRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->postRepository->save($post)) {
                $this->flash()->add('success', 'Article ajouté');

                return $this->redirectTo('adminPosts@index');
            }
        }

        return $this->render('admin/posts/form.html.twig', [
            'post' => $post,
            'form' => $form
        ]);
    }

    public function edit(int $id): Response
    {
        $post = $this->postRepository->findOne(['id' => $id]);

        if (!$post) {
            die('404'); // TODO
        }

        $form = new PostForm($post);
        $form->handleRequest($this->getRequest());

        if ($form->isSubmitted() && $form->isValid()) {

            if ($this->postRepository->save($post)) {
                $this->flash()->add('success', 'Article modifié');

                return $this->redirectTo('adminPosts@index');
            }
        }

        return $this->render('admin/posts/form.html.twig', [
            'post' => $post,
            'form' => $form
        ]);
    }

    public function delete(int $id): Response
    {
        $post = $this->postRepository->findOne(array('id' => $id));

        if (!$post) {
            die('404'); // TODO
        }

        $form = new PostDeleteForm();
        $form->handleRequest($this->getRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->postRepository->delete($post)) {
                $this->flash()->add('success', "L'article a bien été supprimé");
            }
        }

        return $this->redirectTo('adminPosts@index');
    }
}