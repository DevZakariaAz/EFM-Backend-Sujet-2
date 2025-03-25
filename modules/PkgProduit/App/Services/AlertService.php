<?php

namespace Modules\PkgProduit\App\Services;

use Modules\PkgProduit\Models\Produit;  
use Modules\PkgProduit\Models\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AlertService
{
    public function getProduitsEnAlerte(): Collection
    {
        // Fetch all produits
        $produits = Produit::all();
        
        // Fetch all rules
        $rules = Rule::all();

        $alertProduits = collect();

        // Loop through products and check each rule
        foreach ($produits as $produit) {
            foreach ($rules as $rule) {
                try {
                    // Apply each rule to the product dynamically
                    $result = $this->applyRuleToProduct($rule->expression, $produit);
                    
                    // If the rule is satisfied, add the product to the alert list
                    if ($result === true) {
                        $alertProduits->push($produit);
                        break;  // No need to check further rules if one is satisfied
                    }
                } catch (\Exception $e) {
                    Log::error("Error applying rule to product {$produit->id}: {$e->getMessage()}");
                }
            }
        }

        return $alertProduits;
    }

    private function applyRuleToProduct($expression, $produit)
    {
        // For now, this is a basic implementation
        // Ideally, you'd use a Rule Engine to evaluate the expression dynamically

        // Example of handling stock and price directly
        $expression = str_replace('stock', $produit->stock, $expression);
        $expression = str_replace('prix', $produit->prix, $expression);
        
        // Evaluate the expression (Warning: eval can be risky if not sanitized)
        // For simplicity, this is just an example. Use a proper rule engine.
        eval("\$result = ($expression);");
        
        return $result;
    }
}
