<?php

namespace App\Controller;

use App\Form\ContactForm;
use App\Repository\PostRepository;
use Framework\Controller\AbstractController;
use Framework\Http\Response;

class PagesController extends AbstractController
{
    protected $layout = 'base_layout';

    public function index(): Response
    {
        $postRepository = $this->getRepository(PostRepository::class);

        $posts = $postRepository->findForHomePage();

        $form = new ContactForm();

        $form->handleRequest($this->getRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            $smtp = $this->config('Application')['smtp'];

            $transport = (new \Swift_SmtpTransport($smtp['host'], $smtp['port'], 'ssl'))
                ->setUsername($smtp['username'])
                ->setPassword($smtp['password']);

            $mailer = new \Swift_Mailer($transport);

            $message = (new \Swift_Message('[Contact via site] - Nouvelle demande'))
                ->setFrom([$form->get('email') => $form->get('firstname') . ' ' . $form->get('lastname')])
                ->setTo([$smtp['contact_email']])
                ->setBody($form->get('message'));

            $result = $mailer->send($message);

            if ($result) {
                $this->flash()->add('success', 'Votre message a bien été envoyé. Une réponse vous sera apportée sous peu.');
            } else {
                $this->flash()->add('danger', 'Le message n\'a pas pu être envoyé. Veuillez réessayer ultérieurement.');
            }

            $form->clear();
        }


        return $this->render('pages/index.html.twig', [
            'posts' => $posts,
            'form'  => $form
        ]);
    }
}