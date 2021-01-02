<?php

return [
    ['/', 'pages@index', ['GET']],

    ['/articles', 'posts@index', ['GET']],
    ['/article/:slug', 'posts@show', ['GET']],


    ['/users', [
        ['/register', 'users@register', ['GET', 'POST']]
    ]],
];