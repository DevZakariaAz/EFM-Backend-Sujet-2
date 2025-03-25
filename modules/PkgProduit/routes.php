<?php

use Modules\PkgProduit\Controllers\RuleEngineController;
use Illuminate\Support\Facades\Route;

Route::get('/rule-engine-test', [RuleEngineController::class, 'testRule'])
    ->name('rule.engine.test');
