<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Modules\PkgProduit\Models\Rule;

class RuleSeeder extends Seeder
{
    public function run()
    {
        Rule::insert([
            ['label' => 'Stock faible', 'expression' => 'stock <++ 5'],
            ['label' => 'Prix élevé', 'expression' => 'prix > 1000']
        ]);
    }
}
