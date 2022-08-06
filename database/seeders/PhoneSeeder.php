<?php

namespace Database\Seeders;

use App\Models\Phone;
use App\Models\phones_ensas;
use App\Models\phones_websites;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phones = ["0625041407", "0712563223"];

        foreach ($phones as $phone) {
            $id = Phone::create([
                'phone_number' => $phone,
                'type' => "mobile"
            ])->id;
            phones_ensas::create([
                'phone_id' => $id,
                'e_n_s_a_id' => 1
            ]);
            phones_websites::create([
                'phone_id' => $id,
                'website_id' => 1
            ]);
        }
    }
}
