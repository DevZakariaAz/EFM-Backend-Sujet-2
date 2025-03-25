<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\PkgProduit\Models\Rule;


class RuleSeeder extends Seeder
{

    public function run()
    {
        Rule::create([
            'label' => 'Low Stock Alert',
            'expression' => 'stock < 5',
        ]);

        Rule::create([
            'label' => 'High Price Alert',
            'expression' => 'prix > 100',
        ]);
    }

}
