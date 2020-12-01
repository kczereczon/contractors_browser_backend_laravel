<?php

namespace Database\Seeders;

use App\Models\Contractor;
use App\Models\Departament;
use App\Models\Contact;
use Illuminate\Database\Seeder;
use PhpParser\Node\Expr\AssignOp\Concat;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        \App\Models\Contractor::factory(10)->has(Departament::factory()->count(3))->has(Contact::factory()->count(1))->create(); 


    }
}