<?php

use Modules\PkgProduit\Controllers\RuleEngineController;
use Illuminate\Support\Facades\Route;
use Modules\PkgProduit\Controllers\ProduitController;

Route::get('/rule-engine-test', [RuleEngineController::class, 'testRule'])
    ->name('rule.engine.test');

Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
