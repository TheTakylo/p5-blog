<?php

namespace App\Form;

use Framework\Form\AbstractForm;
use Framework\Form\Constraints\Csrf;
use Framework\Form\Constraints\NotEmpty;
use Framework\Form\Constraints\NotNull;
use Framework\Form\Type\CsrfType;
use Framework\Form\Type\TextareaType;
use Framework\Form\Type\TextType;

class PostForm extends AbstractForm
{
    public function __construct($entity)
    {
        parent::__construct(
            array(
                'title'       => new TextType(
                    new NotNull(),
                    new NotEmpty()
                ),
                'content'     => new TextareaType(
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