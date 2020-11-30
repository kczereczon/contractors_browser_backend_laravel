<?php

namespace Database\Seeders;

use App\Models\Contractor;
use App\Models\Departament;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Contractor::factory(10)->has(Departament::factory()->count(3))->create(); 
    }
}