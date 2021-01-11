<?php

namespace App\Controller;

use Framework\Controller\AbstractController;

class AdminBaseController extends AbstractController
{
    protected $layout = 'base_admin';

    public function __construct()
    {
        parent::__construct();

        if (!$this->session()->has('user') || $this->session()->has('user') && $this->session()->get('user')->is_admin === 0) {
            return $this->redirectTo('users@login', [], 302);
        }
    }
}