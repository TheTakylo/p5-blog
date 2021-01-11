<?php

namespace Framework\Templating\TwigHelpers;

use Framework\Configuration\Store;
use Framework\Helpers\UrlsHelper;
use Twig\TwigFunction;

class Urls
{

    static function init()
    {
        $twig = Store::getInstance()->getTwig();

        $twig->addFunction(new TwigFunction('route', function (string $routeName, $parameters = false) {
            return Urls::route($routeName, $parameters);
        }));

        $twig->addFunction(new TwigFunction('urls_match', function (string $routeName) {
            return Urls::match($routeName);
        }));

        $twig->addFunction(new TwigFunction('urls_prefix', function (string $prefix) {
            return Urls::prefix($prefix);
        }));
    }

    static function route(string $routeName, $parameters = false): string
    {
        return UrlsHelper::route($routeName, $parameters);
    }

    static function match($routeName): bool
    {
        if (is_array($routeName)) {
            foreach ($routeName as $route => $v) {
                if (Store::getInstance()->getRouter()->match()->getFullName() !== $v) {
                    continue;
                }

                return true;
            }
        }


        if (Store::getInstance()->getRouter()->match()->getFullName() === $routeName) {
            return true;
        }

        return false;
    }

    static function prefix($group): bool
    {
        return Store::getInstance()->getRouter()->match()->prefix($group);
    }

}