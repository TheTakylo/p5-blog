<?php

namespace Framework\Form\Constraints;

class NotEmpty extends AbstractConstraint
{
    public function __construct($errorMessage = 'Le champ ne doit pas être vide')
    {
        parent::__construct($errorMessage);
    }

    public function isValid($value): bool
    {
        return is_string($value) && mb_strlen($value) > 0;
    }
}
