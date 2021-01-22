<?php

namespace Framework\Form;

use Framework\Database\Entity\AbstractEntity;
use Framework\Form\Type\AbstractType;
use Framework\Http\Request;

abstract class AbstractForm
{

    public $fields;

    /** @var AbstractEntity|null $entity */
    public $entity;

    public function __construct($fields = array(), &$entity = null)
    {
        $this->fields = $fields;
        $this->entity = $entity;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function handleRequest(Request $request)
    {
        if ($this->isSubmitted()) {

            /**
             * @var string $fieldName
             * @var  AbstractType $fieldType
             */
            foreach ($this->getFields() as $fieldName => $fieldType) {
                $value = $request->post->get($fieldName);

                $fieldType->setValue($value);

                if ($this->entity !== null) {
                    $method = 'set' . ucfirst($fieldName);

                    if (method_exists($this->entity, $method)) {
                        $this->entity->$method($request->post->get($fieldName));
                    }
                }

            }
        }
    }

    public function isSubmitted(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function isValid(): bool
    {
        $isValid = true;

        /**
         * @var string $fieldName
         * @var  AbstractType $fieldType
         */
        foreach ($this->getFields() as $fieldName => $fieldType) {
            $isValid &= $fieldType->isValid();
        }

        return $isValid;
    }

    public function getErrorsMessages(): array
    {
        $errorsMessages = array();

        /**
         * @var string $fieldName
         * @var  AbstractType $fieldType
         */
        foreach ($this->getFields() as $fieldName => $fieldType) {
            $_errorsMessages = $fieldType->getErrorsMessages();

            if (!empty($_errorsMessages)) {
                $errorsMessages[$fieldName] = $_errorsMessages;
            }
        }

        return $errorsMessages;
    }

    public function get($fieldName)
    {
        /** @var AbstractType $field */
        $field = $this->getFields()[$fieldName];

        if ($field === null) {
            throw new \Exception();
        }

        return $field->getValue();
    }
}