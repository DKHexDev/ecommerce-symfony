# Ecommerce Symfony

Pour récupèrer le projet :

```bash
git clone ...
cd projet
composer install
```

Pour configurer la base de données, on n'oublie pas
de créer un fichier `.env.local` avec les lignes
suivantes :

```bash
DATABASE_URL=...
```

Atention de bien créer la BDD :

```bash
php bin/console doctrine:database:create
```

Et aussi, il faut synchroniser la BDD :

```bash
php bin/console doctrine:migrations:migrate
```