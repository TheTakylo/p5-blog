<?php

namespace Framework\Templating\TwigHelpers;

use Framework\Configuration\Store;
use Twig\TwigFunction;

class Form
{

    static function init()
    {
        $twig = Store::getInstance()->getTwig();

        $twig->addFunction(new TwigFunction('form_get', function (string $item) {
            return Form::get($item);
        }));
    }

    static function get($item)
    {
        return (new \Framework\Http\Request())->post->get($item);
    }
}
