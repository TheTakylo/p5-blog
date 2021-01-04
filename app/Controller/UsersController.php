<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Framework\Controller\AbstractController;
use Framework\Helpers\FormHelper;
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

    public function register(): Response
    {
        if ($this->request->getMethod() === 'POST') {
            if (FormHelper::notEmpty('form-firstname') || FormHelper::notEmpty('form-lastname') || FormHelper::notEmpty('form-email') || FormHelper::notEmpty('form-password') || FormHelper::notEmpty('form-checkbox')) {
                $data = $this->request->post->all();

                if (filter_var($data['form-email'], FILTER_VALIDATE_EMAIL)) {

                    if (empty($this->userRepository->findOne(['email' => $data['form-email']]))) {
                        $user = new User();
                        $user->setFirstname($data['form-firstname'])
                            ->setLastname($data['form-lastname'])
                            ->setEmail($data['form-email'])
                            ->setPassword(password_hash($data['form-password'], PASSWORD_BCRYPT));

                        if ($this->userRepository->save($user)) {
                            $this->flash()->add('success', 'Votre compte a bien été crée. Vous pouvez maintenant vous connecter');
                            return $this->redirectTo('users@login');
                        } else {
                            $this->flash()->add('danger', 'Une erreur est survenue.');
                        }
                    } else {
                        $this->flash()->add('danger', 'Cette adresse email est déjà utilisé pour un autre compte.');
                    }
                } else {
                    $this->flash()->add('danger', 'Veuillez entrez une adresse email valide.');
                }
            } else {
                $this->flash()->add('danger', 'Veuillez remplir tous les champs.');
            }
        }

        return $this->render('users/register.php');
    }

    public function login(): Response
    {
        if ($this->request->getMethod() === 'POST') {
            if (FormHelper::notEmpty('form-email') || FormHelper::notEmpty('form-password')) {
                $data = $this->request->post->all();

                if (filter_var($data['form-email'], FILTER_VALIDATE_EMAIL)) {
                    $user = $this->userRepository->findOne(['email' => $data['form-email']]);

                    if (password_verify($data['form-password'], $user->getPassword())) {
                        $this->session()->set('user', $user);

                        return $this->redirectTo('pages@index');
                    } else {
                        $this->flash()->add('danger', 'Les identifiants sont incorrects.');
                    }
                } else {
                    $this->flash()->add('danger', 'Veuillez entrez une adresse email valide.');
                }
            } else {
                $this->flash()->add('danger', 'Veuillez remplir tous les champs.');
            }
        }

        return $this->render('users/login.php');
    }

    public function logout(): Response
    {
        if ($this->session()->has('user')) {
            $this->session()->clear();
        }

        return $this->redirectTo('pages@index');
    }
}