<?php

namespace Framework\Form\Constraints;

abstract class AbstractConstraint
{

    private $errorMessage;

    public function __construct($errorMessage = 'Il y a une erreur')
    {
        $this->errorMessage = $errorMessage;
    }

    abstract public function isValid($value): bool;

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

}
