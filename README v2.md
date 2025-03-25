D'accord, voici l'implémentation complète de **Dossier 1**, en passant des **models** aux **views** dans Laravel.  

---

## 🚀 **Dossier 1 : Moteur de Règles Dynamiques**
L'objectif est de :
1. **Créer un modèle `Produit`** pour stocker les données.
2. **Créer un service `RuleEngine`** pour évaluer dynamiquement une règle.
3. **Créer un contrôleur `RuleController`** pour gérer la logique.
4. **Créer une vue `test-rule.blade.php`** pour afficher le résultat.

---

## 📌 **1️⃣ – Création du Modèle `Produit`**
Nous créons un modèle `Produit` avec une migration associée.

### 📜 **Code : `app/Models/Produit.php`**
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'stock', 'prix'];
}
```

---

### 📜 **Code : `database/migrations/2024_03_25_create_produits_table.php`**
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
👉 **Exécute la migration** :
```sh
php artisan migrate
```

---

## 📌 **2️⃣ – Création du Service `RuleEngine`**
Ce service permet d'évaluer dynamiquement des règles sur un produit.

### 📜 **Code : `app/Services/RuleEngine.php`**
```php
namespace App\Services;

use Exception;

class RuleEngine
{
    /**
     * Évalue une expression logique sur un produit.
     *
     * @param string $expression
     * @param array $data
     * @return bool
     */
    public function evaluate(string $expression, array $data): bool
    {
        try {
            extract($data);

            if (preg_match('/[^a-zA-Z0-9_\s<>=!&|()]/', $expression)) {
                throw new Exception("Expression invalide.");
            }

            return eval("return $expression;");
        } catch (Exception $e) {
            return false;
        }
    }
}
```

---

## 📌 **3️⃣ – Création du Contrôleur `RuleController`**
Ce contrôleur récupère un produit, applique une règle et envoie le résultat à la vue.

### 📜 **Code : `app/Http/Controllers/RuleController.php`**
```php
namespace App\Http\Controllers;

use App\Models\Produit;
use App\Services\RuleEngine;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    public function testRule()
    {
        $ruleEngine = new RuleEngine();

        // On simule un produit existant (ou récupérer en BDD)
        $produit = Produit::first() ?? new Produit([
            'nom' => 'Ordinateur Gamer',
            'stock' => 2,
            'prix' => 1500
        ]);

        // Définition de la règle dynamique
        $expression = 'stock < 5 && prix > 1000';

        // Évaluation de la règle
        $result = $ruleEngine->evaluate($expression, $produit->toArray());

        return view('test-rule', compact('produit', 'expression', 'result'));
    }
}
```

---

## 📌 **4️⃣ – Création de la Vue `test-rule.blade.php`**
Affiche le produit, la règle et le résultat.

### 📜 **Code : `resources/views/test-rule.blade.php`**
```blade
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Test du moteur de règles</h2>

    <p><strong>Produit :</strong> {{ $produit->nom }}</p>
    <p><strong>Stock :</strong> {{ $produit->stock }}</p>
    <p><strong>Prix :</strong> {{ $produit->prix }}€</p>

    <p><strong>Règle évaluée :</strong> {{ $expression }}</p>
    
    <p><strong>Résultat :</strong> 
        @if($result)
            ✅ La règle est valide !
        @else
            ❌ La règle n'est pas validée.
        @endif
    </p>
</div>
@endsection
```

---

## 📌 **5️⃣ – Ajout de la Route**
Ajoutez cette route dans **`routes/web.php`**.

```php
use App\Http\Controllers\RuleController;

Route::get('/test-rule', [RuleController::class, 'testRule']);
```

---

## 🚀 **Test et Résultat**
### 📌 **1️⃣ – Ajouter un produit à la BDD**
Ajoutez un produit avec **tinker** :
```sh
php artisan tinker
```
```php
use App\Models\Produit;

Produit::create([
    'nom' => 'Ordinateur Gamer',
    'stock' => 2,
    'prix' => 1500
]);
```

### 📌 **2️⃣ – Lancer Laravel**
```sh
php artisan serve
```

### 📌 **3️⃣ – Ouvrir l’URL**
**Accédez à** :  
👉 **http://127.0.0.1:8000/test-rule**

---

## 🎯 **Résultat attendu**
L'affichage de la vue doit donner :
```
Produit : Ordinateur Gamer
Stock : 2
Prix : 1500€
Règle évaluée : stock < 5 && prix > 1000
Résultat : ✅ La règle est valide !
```

---

## 🎯 **Résumé**
✔ **Modèle `Produit`** pour stocker les données  
✔ **Service `RuleEngine`** pour évaluer la règle  
✔ **Contrôleur `RuleController`** pour gérer la logique  
✔ **Vue `test-rule.blade.php`** pour afficher le résultat  
✔ **Route `/test-rule`** pour tester l'application  

---

## 📌 **Bonus : Commandes Laravel utiles**
Voici quelques **commandes utiles** pour ce projet :
```sh
# Créer un modèle avec migration
php artisan make:model Produit -m

# Lancer les migrations
php artisan migrate

# Ouvrir Tinker pour insérer des données
php artisan tinker

# Lancer le serveur Laravel
php artisan serve

# Voir les routes disponibles
php artisan route:list
```

---

### 🔥 **C'est terminé pour Dossier 1 ! Tu veux que je continue avec Dossier 2 ?** 🚀