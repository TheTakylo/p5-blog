<?php

namespace Framework\Form\Type;

class TextareaType extends AbstractType
{
    public function setOptions()
    {
        $this->options['html_block'] = 'textarea';

        unset($this->options['html_type']);
    }
}