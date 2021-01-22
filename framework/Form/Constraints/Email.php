<?php

namespace Framework\Form\Constraints;

class Email extends AbstractConstraint
{
    public function __construct($errorMessage = 'Le format de l\'adresse email n\'est pas valide')
    {
        parent::__construct($errorMessage);
    }

    public function isValid($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
