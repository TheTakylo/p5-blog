<?php

namespace Framework\Templating\TwigHelpers;

class TwigHelpersLoaders
{
    static function loadFunctions()
    {
        $functions = [];
        $helpers = ['Assets', 'Flash', 'Form', 'Paginate', 'Session', 'Urls', 'Text'];

        foreach ($helpers as $helper) {
            $class = '\\Framework\\Templating\\TwigHelpers\\' . $helper;
            $class = new $class();

            $class::init();
        }
    }
}
