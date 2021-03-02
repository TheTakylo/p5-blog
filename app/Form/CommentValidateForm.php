<?php

namespace App\Form;

use Framework\Form\AbstractForm;
use Framework\Form\Constraints\Csrf;
use Framework\Form\Type\CsrfType;

class CommentValidateForm extends AbstractForm
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