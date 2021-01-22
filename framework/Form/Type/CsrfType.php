<?php

namespace Framework\Form\Type;

class CsrfType extends AbstractType
{
    public function setOptions()
    {
        $this->options['html_type'] = 'hidden';
    }

    public function isValid(): bool
    {

        $isValid = parent::isValid();

        $this->setValue(null);

        return $isValid;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public static function generate(): string
    {
        $csrf = [
            'token'     => bin2hex(random_bytes(32)),
            'createdAt' => new \DateTime()
        ];

        $_SESSION['_csrf_token'] = $csrf;

        return $csrf['token'];
    }
}