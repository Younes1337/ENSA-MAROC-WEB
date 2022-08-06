<?php

namespace Database\Seeders;

use App\Models\Event;
use Faker\Factory;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $geo = "(GeomFromText('POINT(" . $faker->latitude() . " " . $faker->longitude() . ")'))";

        for($i = 0; $i < 10; $i++) {
            $tags = $faker->text($maxNbChars = 8);
            for ($j = 0; $j < 7; $j++)
                $tags .=  "," . $faker->text($maxNbChars = 8);

            Event::create([
                'title' => $faker->text($maxNbChars = 90),
                'description' => $faker->text(),
                'short_description' => $faker->text($maxNbChars = 255),
                'location' => DB::raw($geo),
                'city' => $faker->text($maxNbChars = 20),
                'tags' => $tags,
                'start_at' => $faker->DateTime,
                'image' => "/storage/uploads/events/default.jpg",
                'end_at' => $faker->DateTime,
                'e_n_s_a_id' => 1
            ]);
        }
    }
}
