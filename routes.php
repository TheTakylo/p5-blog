<?php

return [
    ['/', 'pages@index', ['GET']],

    ['/articles', [
        ['', 'posts@index', ['GET']],
        ['/:slug', 'posts@show', ['GET', 'POST']],
    ]],

    ['/users', [
        ['/register', 'users@register', ['GET', 'POST']],
        ['/login', 'users@login', ['GET', 'POST']],
        ['/logout', 'users@logout', ['GET']]
    ]],
    ['/admin', [
        ['', 'admin@index', ['GET']],
        ['/posts', 'adminPosts@index', ['GET']],
        ['/posts/add', 'adminPosts@add', ['GET', 'POST']],
        ['/posts/edit/:id', 'adminPosts@edit', ['GET', 'POST']],
        ['/posts/:id', 'adminPosts@delete', ['DELETE']],

        ['/comments', 'adminComments@index', ['GET']],
        ['/comments/validate/:id', 'adminComments@validate', ['POST']],
        ['/comments/delete/:id', 'adminComments@delete', ['DELETE']]
    ],
    ],
];