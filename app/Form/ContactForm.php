<?php

namespace App\Form;

use Framework\Form\AbstractForm;
use Framework\Form\Constraints\Csrf;
use Framework\Form\Constraints\Email;
use Framework\Form\Constraints\NotEmpty;
use Framework\Form\Constraints\NotNull;
use Framework\Form\Type\CsrfType;
use Framework\Form\Type\EmailType;
use Framework\Form\Type\TextareaType;
use Framework\Form\Type\TextType;

class ContactForm extends AbstractForm
{
    public function __construct()
    {
        parent::__construct(
            array(
                'firstname'   => new TextType(
                    new NotNull(),
                    new NotEmpty()
                ),
                'lastname'    => new TextType(
                    new NotNull(),
                    new NotEmpty()

                ),
                'email'       => new EmailType(
                    new NotNull(),
                    new NotEmpty(),
                    new Email()
                ),
                'message'     => new TextareaType(
                    new NotNull(),
                    new NotEmpty()
                ),
                '_csrf_token' => new CsrfType(
                    new Csrf()
                )
            )
        );
    }
}