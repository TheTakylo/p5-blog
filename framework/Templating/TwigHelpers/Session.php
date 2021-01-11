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

        $twig->addFunction(new TwigFunction('isAdmin', function () {
            return Session::isAdmin();
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

    static function isAdmin(): bool
    {
        return self::isLogged() && self::get('user')->getIs_admin() === 1;
    }

}
