<?php

namespace App\Form;

use Framework\Form\AbstractForm;
use Framework\Form\Constraints\Csrf;
use Framework\Form\Constraints\NotEmpty;
use Framework\Form\Constraints\NotNull;
use Framework\Form\Type\CsrfType;
use Framework\Form\Type\PasswordType;

class UserPasswordForm extends AbstractForm
{
    public function __construct()
    {
        parent::__construct(
            array(
                'password'        => new PasswordType(
                    new NotNull(),
                    new NotEmpty()
                ),
                'password_repeat' => new PasswordType(
                    new NotNull(),
                    new NotEmpty()
                ),
                '_csrf_token'     => new CsrfType(
                    new Csrf()
                )
            )
        );
    }
}