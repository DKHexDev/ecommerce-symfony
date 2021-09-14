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

## La partie produits

On va créer une entité Product :

- Id (déjà fait par Symfony)
- Nom (Le produit)
- Slug (le-produit)
- Description (Text)
- Prix (decimal)
- Date de création
- Coup de coeur (Boolean)
- Image du produit (peut être null)
- Promotion (entier en pourcentage, peut être null)

Ne pas oublier de créer les migrations et d'appliquer les migrations.