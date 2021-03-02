<?php

namespace Framework\Templating\TwigHelpers;

use Framework\Configuration\Store;
use Twig\TwigFunction;

class Paginate
{

    static function init()
    {
        $twig = Store::getInstance()->getTwig();

        $twig->addFunction(new TwigFunction('paginate_show', function (string $repository) {
            Paginate::show($repository);
        }));
    }

    static function show($repository)
    {
        $repository = new $repository();

        $page = (Store::getInstance()->get('Request')->get->get('page')) ?? 1;
        $nb = ceil($repository->count() / $repository::getMaxElements()) + 1;

        if ($nb - 1 <= 1) {
            return;
        }

        $pagination = "<nav><ul class='pagination'>";

        $statePrev = ($page == 1) ? 'disabled' : '';
        $stateNext = ($nb == $page + 1) ? 'disabled' : '';

        $pagination .= "<li class='page-item {$statePrev}'><a class='page-link' href='?page=" . ($page - 1) . "'>Précedent</a></li>";

        for ($i = 1; $i < $nb; $i++) {
            $current = ($i == $page) ? 'active' : '';
            $pagination .= "<li class='page-item {$current}'><a class='page-link' href='?page={$i}'>{$i}</a></li>";
        }

        $pagination .= "<li class='page-item {$stateNext}'><a class='page-link' href='?page=" . ($page + 1) . "'>Suivant</a></li>";

        $pagination .= "</ul></nav>";

        echo $pagination;
    }
}