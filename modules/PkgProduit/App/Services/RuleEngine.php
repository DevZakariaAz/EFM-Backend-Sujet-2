<?php

namespace Modules\PkgProduit\App\Services;

use Modules\PkgProduit\Models\Produit;

class RuleEngine
{
    /**
     * Retrieves the first product from the database, applies a sample rule,
     * and returns an array with the product, the rule, and the evaluation result.
     *
     * @return array
     */
    public function evaluate(): array
    {
        // Retrieve the first product from the database.
        $product = Produit::first();

        if (!$product) {
            return ['error' => 'No product found in the database.'];
        }

        // Map product data. Note: The DB column 'prix' is mapped to 'price' for the rule.
        $productData = [
            'stock' => $product->stock,
            'price' => $product->prix,
        ];

        // Define the rule expression.
        $rule = 'stock < 5 && price > 100';

        // Extract variables from the product data to be used in the eval() scope.
        extract($productData);

        try {
            // WARNING: Using eval() can be dangerous.
            // This implementation is for demonstration purposes only.
            $result = eval("return {$rule};");

            // Ensure the result is boolean.
            if (!is_bool($result)) {
                throw new \Exception("The expression did not return a boolean value.");
            }
        } catch (\Throwable $e) {
            // In a production app, log the error and/or handle it appropriately.
            $result = false;
        }

        // Return all necessary data.
        return [
            'product' => $product,
            'rule'    => $rule,
            'result'  => $result,
        ];
    }
}
