<?php

namespace Framework\Form\Type;

class EmailType extends AbstractType
{
    public function setOptions()
    {
        $this->options['html_type'] = 'email';
    }
}