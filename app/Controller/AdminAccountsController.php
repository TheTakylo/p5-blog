<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserForm;
use App\Repository\UserRepository;
use Framework\Http\Response;

class AdminAccountsController extends AdminBaseController
{

    /** @var UserRepository $userRepository */
    private $userRepository;

    public function __construct()
    {
        parent::__construct();

        $this->userRepository = $this->getRepository(UserRepository::class);
    }

    public function index(): Response
    {
        $accounts = $this->userRepository->findAll();

        return $this->render('admin/accounts/index.html.twig', [
            'accounts' => $accounts
        ]);
    }

    public function add(): Response
    {
        $user = new User();
        $form = new UserForm($user);

        $form->handleRequest($this->getRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(password_hash($user->getPassword(), PASSWORD_BCRYPT));

            if ($this->userRepository->save($user)) {
                $this->flash()->add('success', 'Compte ajouté');

                return $this->redirectTo('adminAccounts@index');
            }
        }

        return $this->render('admin/accounts/form.html.twig', [
            'user' => $user,
            'form' => $form
        ]);
    }

    public function edit(int $id): Response
    {
        $user = $this->userRepository->findOne(['id' => $id]);

        if (!$user) {
            return $this->createNotFound();
        }

        $form = new UserForm($user);
        $form->handleRequest($this->getRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->userRepository->save($user)) {
                $this->flash()->add('success', 'Compte modifié');

                return $this->redirectTo('adminAccounts@index');
            }
        }

        return $this->render('admin/accounts/form.html.twig', [
            'user' => $user,
            'form' => $form
        ]);
    }

    public function delete(int $id): Response
    {
        $users = $this->userRepository->findAll();

        if (count($users) <= 1) {
            $this->flash()->add('danger', "Vous ne pouvez pas supprimer le seul compte administrateur");

            return $this->redirectTo('adminAccounts@index');
        }

        $user = $this->userRepository->findOne(array('id' => $id));

        if (!$user) {
            return $this->createNotFound();
        }

        $form = new AddUserForm();
        $form->handleRequest($this->getRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->userRepository->delete($user)) {
                $this->flash()->add('success', "Le compte a bien été supprimé");
            }
        }

        return $this->redirectTo('adminAccounts@index');
    }
}