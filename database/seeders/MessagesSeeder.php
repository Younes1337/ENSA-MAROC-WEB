<?php

namespace Database\Seeders;

use App\Models\Message;
use Faker\Factory;
use Illuminate\Database\Seeder;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for($i = 0; $i < 5; $i++) {
            Message::create([
                'sender_firstName' => $faker->text($maxNbChars = 40),
                'sender_lastName' => $faker->text($maxNbChars = 40),
                'email' => $faker->text($maxNbChars = 40),
                'sender_type' => $faker->text($maxNbChars = 40),
                'date_time_sent' => $faker->dateTime($max = 'now', $timezone = null),
            ]);
        }
    }
}
