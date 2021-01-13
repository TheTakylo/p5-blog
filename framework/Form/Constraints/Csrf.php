<?php

namespace Framework\Form\Constraints;

class Csrf extends AbstractConstraint
{
    public function __construct($errorMessage = 'Le token csrf n\'est pas valide')
    {
        parent::__construct($errorMessage);
    }

    public function isValid($value): bool
    {
        if (!isset($_SESSION['_csrf_token'])) {
            return false;
        }

        if (empty($_SESSION['_csrf_token'])) {
            return false;
        }

        if ($_SESSION['_csrf_token'] === $value) {
            return true;
        }

        return false;
    }
}
