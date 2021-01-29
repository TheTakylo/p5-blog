<?php

return [
    ['', 'pages@index', ['GET', 'POST']],

    ['/articles', [
        ['', 'posts@index', ['GET']],
        ['/{slug}-{id}', 'posts@show', ['GET', 'POST']],
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
        ['/posts/edit/{id}', 'adminPosts@edit', ['GET', 'POST']],
        ['/posts/delete/{id}', 'adminPosts@delete', ['DELETE']],

        ['/comments', 'adminComments@index', ['GET']],
        ['/comments/validate/{id}', 'adminComments@validate', ['POST']],
        ['/comments/delete/{id}', 'adminComments@delete', ['DELETE']],

        ['/accounts', 'adminAccounts@index', ['GET']],
        ['/accounts/add', 'adminAccounts@add', ['GET', 'POST']],
        ['/accounts/edit/{id}', 'adminAccounts@edit', ['GET', 'POST']],
        ['/accounts/delete/{id}', 'adminAccounts@delete', ['DELETE']]
    ],
    ],
];