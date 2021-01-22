<?php

namespace Framework\Form\Type;

class PasswordType extends AbstractType
{
    public function setOptions()
    {
        $this->options['html_type'] = 'password';
    }
}