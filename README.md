Voici un fichier `README.md` bien structuré avec les commandes Laravel populaires et du code essentiel pour ton projet EFM.  

---

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

Le projet doit être développé en **architecture modulaire Laravel**, avec l’arborescence suivante :  

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

## 🚀 **Installation et configuration**  

### 1️⃣ **Cloner le projet**  
```sh
git clone https://github.com/ton-repo/catalogue-produits.git
cd catalogue-produits
composer install
```

### 2️⃣ **Créer le fichier `.env` et générer la clé d’application**  
```sh
cp .env.example .env
php artisan key:generate
```

### 3️⃣ **Configurer la base de données (`.env`)**  
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=catalogue_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ **Exécuter les migrations et insérer les données de test**  
```sh
php artisan migrate --seed
```

### 5️⃣ **Lancer le serveur**  
```sh
php artisan serve
```

---

## 📁 **Modèle logique de données (MLD)**  

| Table        | Champs                                        |
|--------------|-----------------------------------------------|
| **produits** | id, nom, stock, prix, created_at, updated_at  |
| **rules**    | id, label, expression (type `text`)           |

---

## 🔧 **Commandes Laravel utiles**  

| Commande                            | Description |
|-------------------------------------|------------|
| `php artisan make:model Produit -m` | Créer un modèle avec une migration |
| `php artisan make:controller ProduitController --resource` | Générer un contrôleur CRUD |
| `php artisan make:service RuleEngine` | Créer un service Laravel |
| `php artisan migrate` | Exécuter les migrations |
| `php artisan db:seed` | Insérer les données de test |
| `php artisan tinker` | Ouvrir une console interactive Laravel |
| `php artisan route:list` | Afficher toutes les routes du projet |
| `php artisan cache:clear` | Vider le cache Laravel |

---

## 🔹 **Code essentiel**  

### 📌 **1. Classe `RuleEngine` pour évaluer les règles dynamiques**  

```php
namespace Modules\PkgProduit\App\Services;

class RuleEngine
{
    public function evaluate(string $expression, array $data): bool
    {
        extract($data); // Extrait les variables pour être utilisables dans l’expression
        try {
            return eval("return $expression;");
        } catch (\Throwable $e) {
            return false; // Gérer les erreurs d’évaluation
        }
    }
}
```

### 📌 **2. Migration pour la table `produits`**  

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->integer('stock');
            $table->decimal('prix', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produits');
    }
};
```

### 📌 **3. Contrôleur `ProduitController` pour gérer les produits**  

```php
namespace Modules\PkgProduit\Controllers;

use Illuminate\Http\Request;
use Modules\PkgProduit\Models\Produit;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::latest()->paginate(10);
        return view('PkgProduit::produits.index', compact('produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'prix' => 'required|numeric|min:0'
        ]);

        Produit::create($request->all());

        return response()->json(['message' => 'Produit ajouté avec succès'], 200);
    }
}
```

### 📌 **4. Vue `dashboard.blade.php` pour afficher les produits en alerte**  

```html
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>🔔 Produits en alerte</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Stock</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produits as $produit)
                <tr>
                    <td>{{ $produit->nom }}</td>
                    <td>{{ $produit->stock }}</td>
                    <td>{{ $produit->prix }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
```

---

## ✅ **Résumé des barèmes**  

| Dossier        | Description                                        | Note |
|----------------|----------------------------------------------------|------|
| Dossier 1      | Prototype – moteur de règles dynamiques            | /5   |
| Dossier 2      | Création (AJAX + modal) + affichage paginé         | /10  |
| Dossier 3      | Tableau de bord avec widget d’alertes dynamiques   | /25  |
| **Total**      |                                                    | **/40** |

---

## 🎯 **Objectifs du projet**  

- ✅ Développer un **module Laravel modulaire**  
- ✅ Implémenter un **moteur de règles dynamiques**  
- ✅ Afficher uniquement les **produits en alerte** dans un **widget de tableau de bord**  
- ✅ Utiliser des **formulaires AJAX** pour la gestion des produits  

📌 **Prêt à coder ? Lance-toi ! 🚀**