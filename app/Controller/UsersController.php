<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Framework\Controller\AbstractController;
use Framework\Http\Response;

class UsersController extends AbstractController
{
    protected $layout = 'base_layout';

    public function register(): Response
    {
        return $this->render('users/register.php');
    }
}