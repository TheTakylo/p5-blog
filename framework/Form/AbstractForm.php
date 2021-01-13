<?php

namespace Framework\Form;

use Framework\Http\Request;

abstract class AbstractForm
{
    abstract public function __construct(
        $fields,
        $datas
    );

    public function handleRequest(Request $request)
    {
    }

    public function isSubmitted()
    {
    }

    public function isValid()
    {
    }
}