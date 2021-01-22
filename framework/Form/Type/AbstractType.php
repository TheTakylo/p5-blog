<?php

namespace Framework\Form\Type;

use Framework\Form\Constraints\AbstractConstraint;

abstract class AbstractType
{
    public $options = array(
        'html_block' => 'input',
        'html_type'  => 'text'
    );

    /** @var AbstractConstraint[] */
    private $constraints;

    /** @var array $errorsMessages */
    private $errorsMessages = array();

    /** @var mixed $value */
    private $value;

    /**
     * @param AbstractConstraint[] $constraints
     */
    public function __construct(...$constraints)
    {
        $this->constraints = $constraints;

        $this->setOptions();
    }

    public function isValid(): bool
    {
        $isValid = true;

        foreach ($this->constraints as $constraint) {
            $constraintValid = $constraint->isValid($this->getValue());

            if (!$constraintValid) {
                $this->errorsMessages[] = $constraint->getErrorMessage();
            }

            $isValid &= $constraintValid;
        }

        return $isValid;
    }

    public function getErrorsMessages(): array
    {
        return $this->errorsMessages;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return null|string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setOptions()
    {
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}