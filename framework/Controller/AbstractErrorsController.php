<?php

namespace Framework\Controller;

use Framework\Http\Response;

abstract class AbstractErrorsController extends AbstractController
{
    public function error404(): Response
    {
        $response = new Response();
        $response->setContent('Page not found');
        $response->setStatusCode(404);

        return $response;
    }

    public function error(): Response
    {
        $response = new Response();
        $response->setContent('Server error');
        $response->setStatusCode(500);

        return $response;
    }
}