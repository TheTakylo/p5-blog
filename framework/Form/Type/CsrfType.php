<?php

namespace Framework\Form\Type;

class CsrfType extends AbstractType
{

    private static $csrf;

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
        if (!self::$csrf) {
            self::$csrf = [
                'token'     => bin2hex(random_bytes(32)),
                'createdAt' => new \DateTime()
            ];

            $_SESSION['_csrf_token'] = self::$csrf;
        }


        return self::$csrf['token'];
    }
}