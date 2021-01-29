<?php

namespace App\Form;

use Framework\Form\AbstractForm;
use Framework\Form\Constraints\Csrf;
use Framework\Form\Constraints\NotEmpty;
use Framework\Form\Constraints\NotNull;
use Framework\Form\Type\CsrfType;
use Framework\Form\Type\TextType;

class UserDeleteForm extends AbstractForm
{
    public function __construct()
    {
        parent::__construct(
            array(
                '_csrf_token' => new CsrfType(
                    new Csrf()
                )
            )
        );
    }
}