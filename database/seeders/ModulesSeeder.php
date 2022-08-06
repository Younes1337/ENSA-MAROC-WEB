<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::create([
            'title_module' => "Python for Data Science",
            'module_description' => "un module",
            'id_semester' => 1 
        ]);
    }
}
