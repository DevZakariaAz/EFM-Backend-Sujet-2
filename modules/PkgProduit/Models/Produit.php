<?php

namespace Modules\PkgProduit\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    // Define the table if it is not the plural of the model name
    protected $table = 'produits';

    // Allow mass assignment for these fields
    protected $fillable = [
        'nom',
        'stock',
        'prix'
    ];
}
