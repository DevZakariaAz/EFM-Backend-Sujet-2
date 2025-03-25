<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\PkgProduit\Models\Produit;

class ProduitSeeder extends Seeder
{
    public function run()
    {
        // Insert a sample product
        Produit::create([
            'nom'   => 'Product A',
            'stock' => 2,
            'prix'  => 150.00,
        ]);

    }
}
