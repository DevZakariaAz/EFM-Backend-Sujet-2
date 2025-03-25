<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\PkgProduit\Models\Produit;

class ProduitSeeder extends Seeder
{
    public function run()
    {
        Produit::create([
            'nom'   => 'Product A',
            'stock' => 10,
            'prix'  => 150.00,
        ]);

        Produit::create([
            'nom'   => 'Product B',
            'stock' => 3,
            'prix'  => 150.00,
        ]);
        
        Produit::create([
            'nom'   => 'Product C',
            'stock' => 4,
            'prix'  => 150.00,
        ]);

    }
}
