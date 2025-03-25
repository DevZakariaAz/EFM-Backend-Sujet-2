# 🧪 **Contrôle Laravel – Jour 2 : Catalogue de produits avec alertes dynamiques**

## 🧩 **Contexte général**

Tu dois développer un **module Laravel autonome et modulaire** nommé `PkgProduit`, placé dans le dossier `modules/`.

Ce module permet de :
- Gérer un **catalogue de produits** (nom, prix, stock)
- Enregistrer des **règles métier dynamiques** (stockées en base sous forme d'expressions)
- Évaluer ces règles **dynamiquement via une classe `RuleEngine`**
- Afficher uniquement les **produits en alerte**, dans un **widget de tableau de bord**

---

## 🛠️ **Contrainte technique obligatoire**

Le projet doit être développé en **architecture modulaire Laravel**, avec l'arborescence suivante :

```
modules/
└── PkgProduit/
    ├── Controllers/
    ├── Models/
    ├── Views/
    ├── App/
    │   ├── Services/
    │   └── Requests/
    └── lang/
```

Le module doit être **déclaré via un Service Provider personnalisé**.  
Aucune logique métier ne doit sortir du module.

---

## ❗️**Condition d’accès à la suite du contrôle**

- Si tu obtiens **au moins 4/5** au Dossier 1, tu continues.
- Sinon, tu redémarres avec un **autre sujet**. La note obtenue est conservée (sur 5), les autres parties seront notées sur 35.

---

## 🧾 Modèle logique de données (MLD)

| Table        | Champs                                        |
|--------------|-----------------------------------------------|
| **produits** | id, nom, stock, prix, created_at, updated_at  |
| **rules**    | id, label, expression (type `text`)           |

---

# 📁 **Dossier 1 – Prototype : moteur de règles dynamiques**
📖 *Documentation autorisée*  
### 🧮 Note maximale : 5 points  
### ⏱️ Durée : 30 minutes

### 🎯 Objectif :
Implémenter une classe `RuleEngine` capable d’évaluer dynamiquement une règle métier (exprimée en texte) sur un produit.

### 🔹 Questions à traiter :

#### Q1.1 – Créer une classe `RuleEngine` avec une méthode `evaluate(string $expression, array $data): bool`  
**(2 pts)**

#### Q1.2 – Simuler un produit (ex : `['stock' => 2, 'prix' => 150]`) et appliquer une règle (ex : `stock < 5 && prix > 100`), puis afficher le résultat dans une vue simple  
**(3 pts)**

---

# 📁 **Dossier 2 – Création + affichage paginé des produits**
### 🧮 Note maximale : 10 points  
### ⏱️ Durée : 1 heure

### 🎯 Objectif :
Permettre à l’utilisateur d’ajouter des produits via un **formulaire modal AJAX** et d’afficher les produits enregistrés avec **pagination**.

### 🔹 Questions à traiter :

#### Q2.1 – Créer le modèle `Produit`, la migration, et le contrôleur dans le module  
**(2 pts)**

#### Q2.2 – Créer une vue avec un bouton “Ajouter un produit” → ouverture d’un modal contenant le formulaire  
**(2 pts)**

#### Q2.3 – Envoyer le formulaire en AJAX + affichage des erreurs (validation) dans le modal  
**(3 pts)**

#### Q2.4 – Afficher les produits dans une **table paginée (10 produits par page)**, triés par date de création décroissante  
**(3 pts)**

---

# 📁 **Dossier 3 – Tableau de bord avec widget d’alertes dynamiques**
### 🧮 Note maximale : 25 points  
### ⏱️ Durée : 1h30

### 🎯 Objectif :
Créer un **tableau de bord responsive** contenant un **widget** qui affiche uniquement les **produits en alerte**, c’est-à-dire ceux qui valident **au moins une règle métier**.

### 🔹 Questions à traiter :

#### Q3.1 – Créer la table `rules` avec migration et modèle, et y insérer **au moins deux règles** (avec un `label` explicite)  
**(3 pts)**

#### Q3.2 – Implémenter un service `AlertService` avec une méthode publique :  
```php
public function getProduitsEnAlerte(): Collection
```  
Cette méthode doit :
- Récupérer tous les produits
- Récupérer toutes les règles
- Appliquer dynamiquement chaque règle à chaque produit via `RuleEngine`
- Retourner uniquement les produits pour lesquels **au moins une règle retourne true**  
**(8 pts)**

#### Q3.3 – Créer une vue `dashboard.blade.php` contenant un **widget** (carte visuelle ou bloc stylisé) affichant la liste des produits en alerte  
**(7 pts)**

#### Q3.4 – Gérer toutes les erreurs d’évaluation (`RuleEngine`) :  
- Expression invalide (ex : `stock => 5`)
- Variable manquante (`prix`, `stock`, etc.)
- Résultat non booléen  
Affichage d’un message propre sans casser l’interface  
**(7 pts)**

#### Q3.5 – L’interface du tableau de bord doit être **responsive et fonctionnelle sur PC et mobile** (Bootstrap recommandé)  
**(2 pts)**

---

## ✅ **Résumé des barèmes**

| Dossier        | Description                                        | Note |
|----------------|----------------------------------------------------|------|
| Dossier 1      | Prototype – moteur de règles dynamiques            | /5   |
| Dossier 2      | Création (AJAX + modal) + affichage paginé         | /10  |
| Dossier 3      | Tableau de bord avec widget d’alertes dynamiques   | /25  |
| **Total**      |                                                    | **/40** |

---

Souhaites-tu maintenant que je t’envoie la version **PDF ou Word formatée**, ou veux-tu que je t’aide à créer le **starter Laravel** (structure, RuleEngine de base, migrations) ?