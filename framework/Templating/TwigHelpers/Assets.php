<?php

namespace Framework\Templating\TwigHelpers;

use Framework\Configuration\Store;
use Twig\TwigFunction;

class Assets
{

    static function init()
    {
        $twig = Store::getInstance()->getTwig();

        $twig->addFunction(new TwigFunction('asset', function (string $file) {
            return Assets::asset($file);
        }));

        $twig->addFunction(new TwigFunction('assets_css', function (string $file) {
            return Assets::css($file);
        }));

        $twig->addFunction(new TwigFunction('assets_js', function (string $file) {
            return Assets::js($file);
        }));

        $twig->addFunction(new TwigFunction('assets_img', function (string $file) {
            return Assets::img($file);
        }));
    }

    static function asset(string $file): string
    {
        return SITE_URL . "/{$file}";
    }

    static function css(string $file): string
    {
        return SITE_URL . "/css/{$file}";
    }

    static function js(string $file): string
    {
        return SITE_URL . "/js/{$file}";
    }

    static function img(string $file): string
    {
        return SITE_URL . "/images/{$file}";
    }

}
