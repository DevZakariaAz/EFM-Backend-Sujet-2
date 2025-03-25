<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Article;
use App\Policies\ArticlePolicy;
use Modules\PkgProduit\App\Providers\PkgProduitServiceProvider;
use PhpParser\Node\Expr\AssignOp\Mod;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(PkgProduitServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
