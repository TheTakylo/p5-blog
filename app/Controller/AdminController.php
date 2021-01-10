<?php

namespace App\Controller;

use Framework\Controller\AbstractController;
use Framework\Http\Response;

class AdminController extends AbstractController
{
    protected $layout = 'base_admin';

    public function __construct()
    {
        parent::__construct();

        if (!$this->session()->has('user') || $this->session()->has('user') && $this->session()->get('user')->is_admin === 0) {
            return $this->redirectTo('users@login', [], 302);
        }
    }

    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }
}