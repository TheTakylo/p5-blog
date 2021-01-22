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

class LoginForm extends AbstractForm
{
    public function __construct()
    {
        parent::__construct(
            array(
                'email'       => new EmailType(
                    new NotNull(),
                    new NotEmpty(),
                    new Email()
                ),
                'password'    => new PasswordType(
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