<?php

namespace Framework\Templating\TwigHelpers;

use Framework\Configuration\Store;
use Twig\TwigFilter;

class Text
{

    static function init()
    {
        $twig = Store::getInstance()->getTwig();

        $twig->addFilter(new TwigFilter('truncate', function (string $text, $limit = 150) {
            return Text::truncate($text, $limit = 150);
        }));
    }

    static function truncate(string $text, $limit = 150): string
    {
        if (strlen($text) > $limit) {
            $text = $text . ' ';
            $text = substr($text, 0, $limit);
            $text = substr($text, 0, strrpos($text, ' '));

            $text .= '...';
        }

        return $text;
    }

}