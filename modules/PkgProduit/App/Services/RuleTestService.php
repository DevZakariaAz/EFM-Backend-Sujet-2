<?php

namespace Modules\PkgProduit\App\Services;

use Modules\PkgProduit\Models\Produit;

class RuleTestService
{
    protected $ruleEngine;

    /**
     * Inject the RuleEngine dependency.
     *
     * @param RuleEngine $ruleEngine
     */
    public function __construct(RuleEngine $ruleEngine)
    {
        $this->ruleEngine = $ruleEngine;
    }

    /**
     * Retrieve the first product from the database, apply the rule, and return the result.
     *
     * @return array
     */
    public function testRule(): array
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

        // Evaluate the rule.
        $result = $this->ruleEngine->evaluate($rule, $productData);

        // Return all necessary data.
        return [
            'product' => $product,
            'rule'    => $rule,
            'result'  => $result,
        ];
    }
}
