<?php

namespace Framework\Templating\TwigHelpers;

use Framework\Configuration\Store;
use Framework\Session\SessionManager;
use Twig\TwigFunction;

class Session
{

    static function init()
    {
        $twig = Store::getInstance()->getTwig();

        $twig->addFunction(new TwigFunction('session_has', function (string $item) {
            return Session::has($item);
        }));

        $twig->addFunction(new TwigFunction('session_get', function (string $item) {
            return Session::get($item);
        }));

        $twig->addFunction(new TwigFunction('isLogged', function () {
            return Session::isLogged();
        }));
    }

    static function has($item): bool
    {
        return (new SessionManager())->has($item);
    }

    static function get($item)
    {
        return (new SessionManager())->get($item);
    }

    static function isLogged(): bool
    {
        return self::has('user');
    }
}
