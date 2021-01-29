<?php

namespace App\Form;

use Framework\Form\AbstractForm;
use Framework\Form\Constraints\Csrf;
use Framework\Form\Constraints\Email;
use Framework\Form\Constraints\NotEmpty;
use Framework\Form\Constraints\NotNull;
use Framework\Form\Type\CsrfType;
use Framework\Form\Type\EmailType;
use Framework\Form\Type\PasswordType;
use Framework\Form\Type\TextType;

class UserForm extends AbstractForm
{
    public function __construct($entity)
    {
        parent::__construct(
            array(
                'email'       => new EmailType(
                    new NotNull(),
                    new NotEmpty(),
                    new Email()
                ),
                'firstname'   => new TextType(
                    new NotNull(),
                    new NotEmpty()
                ),
                'lastname'    => new TextType(
                    new NotNull(),
                    new NotEmpty()
                ),
                'password'    => new PasswordType(
                    new NotNull(),
                    new NotEmpty()
                ),
                '_csrf_token' => new CsrfType(
                    new Csrf()
                )
            ), $entity
        );
    }
}