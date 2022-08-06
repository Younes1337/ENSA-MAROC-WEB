<?php

namespace Database\Seeders;

use App\Http\Controllers\OpportunityController;
use App\Models\Phone;
use App\Models\Website;
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
        $this->call([
            //ENSASeeder::class,
            //EventSeeder::class,
            NewsSeeder::class,
            OpportunitiesSeeder::class,
            ClubsSeeder::class,
            WebsiteSeeder::class,
            PermissionsSeeder::class,
            UsersTableSeeder::class,
            FAQSeeder::class,
            PhoneSeeder::class,
            ImageSeeder::class,
            SpecialitiesSeeder::class,
            CyclesSeeder::class,
            SemestersSeeder::class,
            ModulesSeeder::class
        ]);
    }
}
