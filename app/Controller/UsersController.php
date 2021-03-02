<?php

namespace App\Controller;

use App\Form\LoginForm;
use App\Repository\UserRepository;
use Framework\Controller\AbstractController;
use Framework\Http\Response;

class UsersController extends AbstractController
{
    protected $layout = 'base_layout';

    /** @var UserRepository $userRepository */
    private $userRepository;

    public function __construct()
    {
        parent::__construct();

        $this->userRepository = $this->getRepository(UserRepository::class);
    }

    public function login(): Response
    {
        if ($this->session()->has('user')) {
            return $this->redirectTo('admin@index');
        }

        $form = new LoginForm();

        $form->handleRequest($this->getRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->userRepository->findOne(['email' => $form->get('email')]);
            if (!empty($user) && password_verify($form->get('password'), $user->getPassword())) {
                $this->session()->set('user', $user);

                return $this->redirectTo('adminAccounts@index');
            } else {
                $this->flash()->add('danger', 'Les identifiants sont incorrects.');
            }
        }

        return $this->render('users/login.html.twig', array(
            'form' => $form
        ));
    }

    public function logout(): Response
    {
        if ($this->session()->has('user')) {
            $this->session()->clear();
        }

        return $this->redirectTo('pages@index');
    }
}