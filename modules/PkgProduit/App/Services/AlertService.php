<?php

namespace Modules\PkgProduit\App\Services;

use Modules\PkgProduit\Models\Produit;
use Modules\PkgProduit\Models\Rule;
use Illuminate\Support\Collection;

class AlertService
{
    public function getProduitsEnAlerte(): Collection
    {
        $produits = Produit::all();
        $rules = Rule::all();
        $alertProducts = collect();

        foreach ($produits as $produit) {

            foreach ($rules as $rule) {
                if ($this->evaluateRule($rule->expression, $produit)) {
                    
                    $alertProducts->push($produit);
                    break;
                }
            }
        }
        return $alertProducts;
    }

    private function evaluateRule(string $expression, Produit $produit): bool
    {
            extract($produit->toArray());
            $stock = $produit['stock'];
            $prix = $produit['prix'];
            $rule = str_replace(['stock', 'prix'], [$stock, $prix], $expression);

            return eval("return ($rule);");

    }
}
