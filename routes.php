<?php

return [
    ['/', 'pages@index', ['GET']],

    ['/article/:slug', 'posts@show', ['GET']]
];