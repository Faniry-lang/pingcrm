À FAIRE (To Do),EN COURS (In Progress),TERMINÉ (Done)
### 🛠️ Setup Projet (Partie 1),### 🏗️ Développement CRUD (Partie 2),### ✅ Finalisation & Test
1. Docker & Environnement (20 min) ,1. Base de Données (20 min),1. Test des Routes Simples (5 min) 
"* Créer docker-compose.yml avec services app (PHP 8.2-fpm), nginx, et mysql (8.0).",* Migration categories: Créer la migration create_categories_table.,"* Tester /hello, /user/Jean, /about."
* Démarrer les conteneurs: docker-compose up -d.,"* Éditer la migration pour ajouter name, slug, description, is_active.",2. Exécution des Seeders (5 min) 
2. Installation & Projet (25 min) ,* Exécuter la migration: php artisan migrate.,* Exécuter tous les seeders: php artisan db:seed.
* Installer Composer si nécessaire.,* Modèle: Créer le modèle Category: php artisan make:model Category.,* Vérifier les données créées via la route /categories.
* Installer Laravel Installer: composer global require laravel/installer.,* Éditer le modèle Category pour définir $fillable et $casts.,3. Exercices Supplémentaires 
* Créer le projet: laravel new mon-projet (ou via Composer).,* Seeder: Créer CategorySeeder: php artisan make:seeder CategorySeeder.,* Créer une route pour afficher une catégorie par son slug.
* Accéder au projet: cd mon-projet.,"* Éditer CategorySeeder.php pour insérer des catégories (Technologie, Science, etc.).",* Ajouter une colonne color à la table categories via une nouvelle migration.
3. Configuration .env (15 min) ,* Enregistrer le seeder dans DatabaseSeeder.php.,* Créer un CategoryController avec la méthode index().
* Copier .env.example en .env.,2. Routes Simples (20 min) ,* Modifier le seeder pour ajouter 3 catégories supplémentaires.
* Configurer APP_URL=http://localhost:8000 et les variables DB_*.,"* Éditer routes/web.php pour créer des routes simples (/hello), avec paramètre (/user/{name}), et retournant une vue (/about).",4. TP Final: CRUD Complet (40 min) 
* Générer la clé d'application: php artisan key:generate.,* Créer la vue resources/views/about.blade.php.,"* Implémenter toutes les fonctionnalités CRUD (Index, Create, Store, Show, Edit, Update, Destroy)."
4. Découverte (20 min) ,3. Setup CRUD (Exercice 1) ,"* Ajouter la pagination (e.g., Category::paginate(15))."
"* Explorer les dossiers clés (app/, routes/, resources/views/, etc.).","* Créer Modèle, Migration, Controller, et Resource: php artisan make:model Category -mcr.",* Gérer les messages flash (succès).
* Lancer le serveur de développement: php artisan serve.,"* Définir les routes resource: Route::resource('categories', CategoryController::class);.",* Bonus: Ajouter une fonctionnalité de recherche.
,4. Validation (Exercice 2) ,
,* Créer StoreCategoryRequest et UpdateCategoryRequest.,
,* Définir les règles de validation et personnaliser les messages.,
,* Intégrer la validation dans le controller.,
,5. Vues Blade (Exercice 3) ,
,"* Créer le layout principal (layouts/app.blade.php) avec Bootstrap, @yield('title') et @yield('content').",
,* Créer la vue Index (categories/index.blade.php).,
,"* Étendre le layout (@extends), définir le titre (@section('title')) et afficher les catégories avec un tableau et les liens d'actions (Voir, Modifier, Supprimer).",
,6. Factories & Seeders (Exercice 4) ,
,* Créer la Factory: php artisan make:factory CategoryFactory.,
,"* Modifier la factory pour générer des données de test (name, description).",
,* Modifier le Seeder pour utiliser la factory: Category::factory()→count(20)→create();.,