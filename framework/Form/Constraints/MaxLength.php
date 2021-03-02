<?php

namespace Framework\Form\Constraints;

class MaxLength extends AbstractConstraint
{

    /** @var int $maxLength */
    private $maxLength;

    public function __construct(int $maxLength)
    {
        $this->maxLength = $maxLength;

        parent::__construct('Le champ ne doit pas dépasser ' . $maxLength . ' caractère' . (($maxLength > 1) ? 's' : ''));
    }

    public function isValid($value): bool
    {
        return $this->maxLength > mb_strlen($value);
    }
}
