# Laravel – Relations & CRUD Produits

## Créer un système complet de gestion de produits

### 🎯 Objectif

* Créer le modèle **Product** avec la relation **Category**
* Mettre à jour le modèle **Category**
* Mettre en place une validation avancée avec **StoreProductRequest**

### 🔐 Règles de validation

* **Name** : requis, unique
* **Price** : requis, positif
* **Category** : requise

---

## 🛠️ Tâches à réaliser

1. Afficher la liste des produits avec les colonnes :

   * Nom
   * Prix
   * Catégorie

2. Implémenter le **CRUD complet** pour les produits :

   * Create
   * Read
   * Update
   * Delete

3. Ajouter l’**eager loading** pour éviter le problème **N+1**

4. Créer des **validations personnalisées** avec des messages d’erreur en français

5. Ajouter des **filtres** :

   * Filtrer les produits par catégorie

6. Ajouter une **recherche** par nom de produit

7. Trier les produits par prix :

   * Croissant
   * Décroissant

8. Afficher le **nombre de produits par catégorie**

---

> *Module : Laravel – Relations & CRUD Produits*
