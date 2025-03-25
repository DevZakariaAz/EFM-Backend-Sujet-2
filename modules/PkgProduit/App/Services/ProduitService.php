<?php

namespace Modules\PkgProduit\App\Services;

use Modules\PkgProduit\Models\Produit;

class ProduitService
{
    public function getAllProduits()
    {
        return Produit::orderBy('created_at', 'desc')->paginate(4);
    }

    public function createProduit($data)
    {
        return Produit::create($data);
    }

}
