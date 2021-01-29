<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentDeleteForm;
use App\Form\CommentValidateForm;
use App\Repository\CommentRepository;
use Framework\Http\Response;

class AdminCommentsController extends AdminBaseController
{

    /** @var CommentRepository $commentRepository */
    private $commentRepository;

    public function __construct()
    {
        parent::__construct();

        $this->commentRepository = $this->getRepository(CommentRepository::class);
    }

    public function index(): Response
    {
        $type = $this->request->get->get('show') ?? 'need-validate';
        $type = ($type === 'need-validate') ? 0 : 1;

        $comments = $this->commentRepository->findAllWithPosts($type);

        if ($type === 0) {
            $commentsValidated = count($this->commentRepository->findWhere(['validated' => 1]));
            $commentsNeedValidate = count($comments);
        } else {
            $commentsValidated = count($comments);
            $commentsNeedValidate = count($this->commentRepository->findWhere(['validated' => 0]));
        }

        return $this->render('admin/comments/index.html.twig', [
            'comments'             => $comments,
            'commentsValidated'    => $commentsValidated,
            'commentsNeedValidate' => $commentsNeedValidate
        ]);
    }

    public function validate(int $id): Response
    {
        /** @var Comment $comment */
        $comment = $this->commentRepository->findOne(array('id' => $id));

        if (!$comment) {
            return $this->createNotFound();
        }

        $form = new CommentValidateForm();
        $form->handleRequest($this->getRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setValidated(1);

            if ($this->commentRepository->save($comment)) {
                $this->flash()->add('success', "Le commentaire a bien été validé");
            }
        }

        return $this->redirectTo('adminComments@index');
    }

    public function delete(int $id): Response
    {
        $comment = $this->commentRepository->findOne(array('id' => $id));

        if (!$comment) {
            return $this->createNotFound();
        }

        $form = new CommentDeleteForm();
        $form->handleRequest($this->getRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->commentRepository->delete($comment)) {
                $this->flash()->add('success', "Le commentaire a bien été supprimé");
            }
        }

        return $this->redirectTo('adminComments@index');
    }
}