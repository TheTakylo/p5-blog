<?php

namespace Framework\Form\Constraints;

class NotNull extends AbstractConstraint
{
    public function __construct($errorMessage = 'Le champ ne doit pas être null')
    {
        parent::__construct($errorMessage);
    }

    public function isValid($value): bool
    {
        return $value !== null;
    }
}
