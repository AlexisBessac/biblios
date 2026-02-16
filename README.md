# Biblios

Biblios est une application web minimale développée avec Symfony pour gérer une petite bibliothèque : livres, auteurs, genres, commentaires et utilisateurs.

**Stack**: PHP, Symfony, Doctrine ORM, Twig, Webpack/Asset (assets dans `assets/`).

## Description
- But : fournir une application simple pour consulter et administrer une collection de livres.
- Fonctionnalités principales : gestion des livres, auteurs, genres, commentaires et utilisateurs.

## Prérequis
- PHP 8.1+
- Composer
- Une base de données compatible Doctrine (MySQL, MariaDB, SQLite pour développement)
- (Optionnel) Symfony CLI

## Installation
1. Cloner le dépôt :

```
git clone <repo-url> biblios
cd biblios
```

2. Installer les dépendances :

```
composer install
```

3. Configurer l'environnement :

```
cp .env .env.local
# Éditez .env.local pour définir DATABASE_URL et autres variables
```

4. Créer la base et exécuter les migrations :

```
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

5. Lancer le serveur de développement :

```
symfony server:start
# ou
php -S 127.0.0.1:8000 -t public
```

Accéder à l'application sur `http://127.0.0.1:8000` (ou l'URL fournie par Symfony CLI).

## Structure importante
- `src/Controller/` : contrôleurs
- `src/Entity/` : entités Doctrine
- `src/Form/` : formulaires
- `templates/` : vues Twig
- `assets/` : JS/CSS et configuration front
- `migrations/` : migrations de base

## Développement
- Pour lancer les outils front (si présents) :

```
# Exemple avec npm/yarn (selon configuration du projet)
npm install
npm run dev
```

## Tests

Exécuter les tests PHPUnit :

```
php bin/phpunit
```

## Contribution
- Ouvrez une issue pour discuter d'une fonctionnalité ou d'un bug.
- Créez une branche feature/bugfix et envoyez une PR.

## Licence

MIT License

Copyright (c) 2026 Alexis Bessac

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

---

Fichier généré automatiquement par l'assistant — contactez Alexis Bessac pour toute question relative au projet.
