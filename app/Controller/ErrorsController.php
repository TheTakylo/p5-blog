<?php

namespace App\Controller;

use Framework\Controller\AbstractErrorsController;
use Framework\Http\Response;

class ErrorsController extends AbstractErrorsController
{
    public function error404(): Response
    {
        return $this->render('_errors/404.html.twig', [], 404);
    }

    public function error(): Response
    {
        return $this->render('_errors/500.html.twig', [], 500);
    }
}