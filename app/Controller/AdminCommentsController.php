<?php

namespace App\Controller;

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
        $comment = $this->commentRepository->findOne(['id' => $id]);

        if ($comment) {
            if ($this->commentRepository->validate($comment->getId())) {
                $this->flash()->add('success', "Le commentaire a bien été validé");
            } else {
                $this->flash()->add('danger', "Erreur lors de la validation du commentaire");
            }
        }

        return $this->redirectTo('adminComments@index');
    }

    public function delete(int $id): Response
    {
        $comment = $this->commentRepository->findOne(['id' => $id]);

        if ($comment) {
            if ($this->commentRepository->remove('id', $id)) {
                $this->flash()->add('success', "Le commentaire a bien été supprimé");
            } else {
                $this->flash()->add('danger', "Erreur lors de la suppression du commentaire");
            }
        }

        return $this->redirectTo('adminComments@index');
    }
}