<?php

namespace App\Controller;

use Framework\Controller\AbstractController;
use Framework\Http\Response;

class ErrorsController extends AbstractController
{
    public function error404(): Response
    {
        return $this->render('_errors/404.html.twig', [], 404);
    }
}