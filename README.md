# p5-blog

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/df65567d899744f19d1f255cd9e13279)](https://app.codacy.com/gh/TheTakylo/p5-blog?utm_source=github.com&utm_medium=referral&utm_content=TheTakylo/p5-blog&utm_campaign=Badge_Grade_Settings)

# Installation

## Récupération des sources

```
git clone git@github.com:TheTakylo/p5-blog.git
```

### Base de données

importer le fichier dump.sql

### Installation des dépendences via composer

```
composer install
```

## Configuration du projet

Fichiers a renommer:

- **application.php.dist** -> **application.php**
- **database.php.dist** -> **database.php**

Remplir le fichier **database.php** avec les informations de la base de données

Remplir la partie **smtp** du fichier **application.php** afin de faire fonctionner l'envoie des emails.

L'adresse email de l'administrateur doit être indiquée dans le fichier **application.php** -> "**contact_email**"

## Lancer le serveur

```
php -S localhost:8000 -t public
```

Puis se rendre à l'adresse http://localhost:8000

# Accès à l'administration

http://localhost:8000/users/login

- **Email:** admin@admin.fr
- **Mot de passe:** admin

