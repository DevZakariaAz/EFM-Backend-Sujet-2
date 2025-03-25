<?php

namespace Modules\PkgProduit\Providers;

use Illuminate\Support\ServiceProvider;

class PkgProduitServiceProvider extends ServiceProvider
{
  public function boot()
  {
    // Charger les routes
    $this->loadRoutesFrom(__DIR__ . '/../routes.php');

    // Charger les vues
    $this->loadViewsFrom(__DIR__ . '/../Views', 'PkgProduit');
  }

  public function register()
  {
    // Enregistrer d'autres services si nécessaire
  }
}
