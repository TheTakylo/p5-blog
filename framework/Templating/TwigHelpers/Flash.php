<?php

namespace Framework\Templating\TwigHelpers;

use Framework\Configuration\Store;
use Framework\Session\FlashManager;
use Twig\TwigFunction;

class Flash
{

    static function init()
    {
        $twig = Store::getInstance()->getTwig();

        $twig->addFunction(new TwigFunction('flash_get', function (string $type) {
            return Flash::get($type);
        }));

        $twig->addFunction(new TwigFunction('flash_all', function () {
            return Flash::all();
        }));
    }

    static function get($type): array
    {
        return (new FlashManager())->get($type);
    }

    static function all(): ?array
    {
        return (new FlashManager())->all();
    }

}
