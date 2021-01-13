<?php

namespace Framework\Form\Type;

use Framework\Form\Constraints\AbstractConstraint;

abstract class AbstractType
{

    /** @var AbstractConstraint[] */
    private $constraints;

    /** @var array $errorsMessages */
    private $errorsMessages;

    /** @var mixed $value */
    private $value;

    /**
     * @param AbstractConstraint[] $constraints
     * @param mixed|null $value
     */
    public function __construct(array $constraints, string $value = null)
    {
        $this->constraints = $constraints;
        $this->value = $value;
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

    public function getValue(): string
    {
        return $this->value;
    }

}