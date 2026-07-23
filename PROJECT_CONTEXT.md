# Contexte du projet 405-group-auto

Ce document a pour objectif d’aider une autre IA (comme Gemini, Claude, Codex, etc.) à comprendre rapidement l’état actuel du projet, sa structure, ses fonctionnalités principales et les points importants à connaître avant de modifier quoi que ce soit.

---

## 1. Vue d’ensemble

Ce projet est une application web Laravel destinée à la présentation et à la vente de véhicules de luxe. Il propose :

- une page d’accueil avec des véhicules mis en avant,
- un catalogue et une recherche de véhicules,
- un panier temporaire côté session,
- une page de favoris,
- un processus de checkout pour les utilisateurs connectés,
- un espace administrateur pour gérer les véhicules.

Le projet semble être à un stade de prototype/prototypage fonctionnel, avec plusieurs fonctionnalités déjà implémentées mais sans intégration de paiement réelle.

---

## 2. Stack technique

- PHP 8.3
- Laravel 13
- Breeze (authentification)
- Spatie Permission (rôles/admin)
- Vite + Tailwind CSS
- Intervention Image pour le traitement des images uploadées
- Base de données via migrations Laravel

### Dépendances principales

- Composer : [composer.json](composer.json)
- NPM : [package.json](package.json)

---

## 3. Structure du projet

### Dossier principal

- [app/](app/) : logique applicative
  - [app/Http/Controllers/](app/Http/Controllers/) : contrôleurs principaux
  - [app/Models/](app/Models/) : modèles Eloquent
  - [app/Providers/](app/Providers/) : providers Laravel
- [routes/](routes/) : définition des routes web et auth
- [resources/views/](resources/views/) : vues Blade
- [database/migrations/](database/migrations/) : schémas de base de données
- [database/seeders/](database/seeders/) : données de départ
- [public/](public/) : fichiers publics et stockage accessible
- [storage/](storage/) : fichiers générés par l’application
- [tests/](tests/) : tests PHPUnit

---

## 4. Modèles principaux

### Modèle Vehicle

Le modèle [app/Models/Vehicle.php](app/Models/Vehicle.php) représente un véhicule.

Champs importants :

- title
- brand
- model
- year
- mileage
- fuel_type
- transmission
- category
- price
- images (stocké comme tableau JSON)
- status
- location
- is_featured

### Modèle User

Le modèle [app/Models/User.php](app/Models/User.php) étend Authenticatable et utilise Spatie Permission pour gérer les rôles.

---

## 5. Routes principales

Les routes sont définies dans [routes/web.php](routes/web.php).

### Pages publiques

- / : accueil du site
- /cars/{vehicle} : détail d’un véhicule
- /vehicles/search : recherche AJAX
- /about : page À propos
- /contact : page contact

### Panier

- /cart : affichage du panier
- /cart/add/{vehicle} : ajout d’un véhicule au panier
- /cart/remove/{id} : suppression d’un article
- /cart/update/{id} : mise à jour de la quantité

### Favoris

- /favorites : page des favoris
- /favorites/toggle/{vehicle} : ajout/suppression d’un favori

### Checkout

- /checkout : page de checkout (nécessite auth)
- /checkout/order : création de commande
- /checkout/success : page de succès

### Administration

- /admin/vehicles : liste des véhicules
- /admin/vehicles/create : création
- /admin/vehicles/{vehicle}/edit : édition
- /admin/vehicles/{vehicle} : mise à jour/suppression

---

## 6. Fonctionnalités implémentées

### 6.1 Catalogue et accueil

Le contrôleur [app/Http/Controllers/VehicleController.php](app/Http/Controllers/VehicleController.php) charge :

- 3 véhicules mis en avant,
- 3 véhicules récents,
- la liste complète des véhicules.

### 6.2 Recherche AJAX

La méthode search() retourne des résultats JSON pour l’autocomplétion de recherche dans la navbar.

### 6.3 Panier

Le panier est stocké en session via la clé cart. Il ne repose pas sur une table dédiée à l’état courant du panier.

Comportement actuel :

- ajout d’un véhicule au panier,
- mise à jour des quantités,
- suppression d’un article,
- calcul du total à partir du panier en session.

### 6.4 Checkout

Le contrôleur [app/Http/Controllers/CheckoutController.php](app/Http/Controllers/CheckoutController.php) permet :

- de valider un panier,
- de créer une entrée dans la table orders,
- de vider la session panier.

Important : ce n’est pas un vrai paiement. C’est un flux de validation simplifié.

### 6.5 Admin véhicules

Le contrôleur [app/Http/Controllers/Admin/VehicleController.php](app/Http/Controllers/Admin/VehicleController.php) permet :

- lister les véhicules,
- créer un véhicule,
- uploader des images,
- convertir les images en WebP,
- éditer et supprimer un véhicule.

### 6.6 Authentification et rôles

Le projet utilise Breeze pour l’authentification. Les rôles sont gérés avec Spatie Permission.

---

## 7. Base de données et migrations

### Migrations importantes

- [database/migrations/2026_06_01_163040_create_vehicles_table.php](database/migrations/2026_06_01_163040_create_vehicles_table.php) : véhicules
- [database/migrations/2026_06_03_134609_create_carts_table.php](database/migrations/2026_06_03_134609_create_carts_table.php) : panier (présent mais pas utilisé comme stockage principal)
- [database/migrations/2026_06_04_181831_create_orders_table.php](database/migrations/2026_06_04_181831_create_orders_table.php) : commandes
- [database/migrations/2026_06_05_115542_create_permission_tables.php](database/migrations/2026_06_05_115542_create_permission_tables.php) : permissions/rôles

### Seeders

- [database/seeders/DatabaseSeeder.php](database/seeders/DatabaseSeeder.php) : crée un utilisateur de test et appelle le seeder de véhicules.
- [database/seeders/VehicleSeeder.php](database/seeders/VehicleSeeder.php) : insère des véhicules de démonstration.
- [database/seeders/RolesAndPermissionsSeeder.php](database/seeders/RolesAndPermissionsSeeder.php) : attribue le rôle admin à un utilisateur.

---

## 8. Vues principales

Les vues Blade sont organisées par domaine :

- [resources/views/welcome.blade.php](resources/views/welcome.blade.php) : page d’accueil
- [resources/views/vehicles/show.blade.php](resources/views/vehicles/show.blade.php) : détail d’un véhicule
- [resources/views/cart/index.blade.php](resources/views/cart/index.blade.php) : panier
- [resources/views/checkout/index.blade.php](resources/views/checkout/index.blade.php) : checkout
- [resources/views/favorites/index.blade.php](resources/views/favorites/index.blade.php) : favoris
- [resources/views/admin/vehicles/](resources/views/admin/vehicles/) : interface admin
- [resources/views/auth/](resources/views/auth/) : pages d’authentification

---

## 9. Commandes utiles pour démarrer

Depuis la racine du projet :

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run build
php artisan serve
```

### Script Composer utile

Le fichier [composer.json](composer.json) contient un script setup qui tente d’installer automatiquement les dépendances et préparer l’environnement.

---

## 10. Points importants à connaître

### 10.1 Le panier est temporaire

Le panier est actuellement stocké en session. Si l’on veut le rendre persistant, il faudra revoir cette logique.

### 10.2 Les images sont stockées localement

Les images uploadées sont enregistrées dans le disque public Laravel et leurs chemins sont stockés dans le champ JSON images du véhicule.

### 10.3 Le checkout n’est pas un vrai paiement

Le flux est fictif et écrit simplement une commande en base, sans passer par Stripe, PayPal ou autre système de paiement.

### 10.4 Le projet est orienté démonstration / MVP

Il contient déjà une structure propre, mais certaines parties sont encore simplifiées pour un prototype.

---

## 11. Recommandation de lecture pour une IA

Si vous devez modifier ou comprendre le projet rapidement, l’ordre recommandé est :

1. [routes/web.php](routes/web.php)
2. [app/Http/Controllers/VehicleController.php](app/Http/Controllers/VehicleController.php)
3. [app/Http/Controllers/CartController.php](app/Http/Controllers/CartController.php)
4. [app/Http/Controllers/CheckoutController.php](app/Http/Controllers/CheckoutController.php)
5. [app/Http/Controllers/Admin/VehicleController.php](app/Http/Controllers/Admin/VehicleController.php)
6. [app/Models/Vehicle.php](app/Models/Vehicle.php)
7. [database/migrations/2026_06_01_163040_create_vehicles_table.php](database/migrations/2026_06_01_163040_create_vehicles_table.php)

---

## 12. État actuel observé

Le projet semble déjà structurément cohérent pour un site de vente automobile Laravel. Les fonctionnalités de base sont présentes, mais il reste encore à renforcer certaines parties métier comme :

- la persistance du panier,
- le traitement des commandes,
- la gestion des images et du stockage,
- la robustesse des validations et des erreurs utilisateur.

Si une IA doit intervenir sur ce projet, elle doit garder en tête que l’application est encore un MVP orienté démonstration.
