<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Speciality;


class SpecialitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Speciality::create([
            'title_specialty' => "Classe preparatoire",
            'e_n_s_a_id' => 1
        ]);
        Speciality::create([
            'title_specialty' => "Genie des Telecommunication et reseau",
            'e_n_s_a_id' => 1
        ]);
    }
}
