<?php

namespace App\Controller;

use Framework\Http\Response;

class AdminController extends AdminBaseController
{
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }
}