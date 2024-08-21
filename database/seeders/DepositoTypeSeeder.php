<?php

namespace Database\Seeders;

use App\Models\DepositoType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepositoTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DepositoType::create([
            'name' => 'bronze', 'return' => 3.00
        ]);
        DepositoType::create([
            'name' => 'silver', 'return' => 5.00
        ]);
        DepositoType::create([
            'name' => 'gold', 'return' => 7.00
        ]);
    }
}
