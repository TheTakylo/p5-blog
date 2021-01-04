<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title><?= $title; ?> | Sébastien Thuret - Blog</title>
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= Assets::css('bootstrap.min.css') ?>">
</head>
<body>
<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
            </div>
            <div class="col-4 text-center">
                <a class="blog-header-logo text-dark" href="#">Blog</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <a class="link-secondary" href="#" aria-label="Search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3"
                         role="img" viewBox="0 0 24 24"><title>Search</title>
                        <circle cx="10.5" cy="10.5" r="7.5"/>
                        <path d="M21 21l-5.2-5.2"/>
                    </svg>
                </a>
            </div>
        </div>
    </header>
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            <div class="d-flex">
                <a class="p-2 link-secondary" href="<?= Urls::route('pages@index'); ?>">Accueil</a>
                <a class="p-2 link-secondary" href="<?= Urls::route('posts@index'); ?>">Articles</a>
            </div>
            <div class="d-flex">
                <?php if (!Session::isLogged()): ?>
                    <a class="p-2 link-secondary" href="<?= Urls::route('users@register'); ?>">Inscription</a>
                    <a class="p-2 link-secondary" href="<?= Urls::route('users@login'); ?>">Connexion</a>
                <?php else: ?>
                    <a class="p-2 link-secondary" href="<?= Urls::route('users@logout'); ?>">Déconnexion</a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</div>
<main class="container">
    <?= $content; ?>
</main>
<footer class="blog-footer">
    <p>Créez votre premier blog en PHP - P5 OpenClassrooms | Sébastien Thuret</p>
    <p>
        <a href="#">Retourner en haut du site</a>
    </p>
</footer>
</body>
</html>
