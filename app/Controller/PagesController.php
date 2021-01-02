<?php

namespace App\Controller;

use Framework\Controller\AbstractController;
use Framework\Http\Response;

class PagesController extends AbstractController
{
    protected $layout = 'base_layout';

    public function index(): Response
    {
        return $this->render('pages/index.php');
    }
}