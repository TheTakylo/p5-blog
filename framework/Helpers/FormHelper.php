<?php

namespace Framework\Helpers;

class FormHelper
{

    static function notEmpty(string $item): bool
    {
        $postRequest = (new \Framework\Http\Request())->post;

        return $postRequest->has($item) && !empty($postRequest->get($item));
    }
}