<?php

namespace Modules\PkgProduit\Controllers;

use App\Http\Controllers\Controller;
use Modules\PkgProduit\App\Services\ProduitService;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    protected $produitService;

    public function __construct(ProduitService $produitService)
    {
        $this->produitService = $produitService;
    }

    public function index()
    {
        $produits = $this->produitService->getAllProduits();
        return view('PkgProduit::produits.index', compact('produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prix' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $produit = $this->produitService->createProduit($request->all());

        return response()->json([
            'message' => 'Produit ajouté avec succès.',
            'produit' => $produit
        ], 201);
    }
}
