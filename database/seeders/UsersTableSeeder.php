<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => "Mohammed",
            'last_name' => "SALEM",
            'email' => "salem.mhmed@yahoo.com",
            'password' => "$2y$10\$ymKR7SweC7HPG6o2fcQJfOYa5/dT0Nh9YWF0mWuO/qxLK61AX5nXW",
            'phone_number' => "06250814507",
            'avatar' => "/storage/uploads/avatars/default.png",
            'e_n_s_a_id' => 1
        ]);

        User::create([
            'first_name' => "Ahmed",
            'last_name' => "Mechrir",
            'email' => "ahmedmechrir@yahoo.com",
            'password' => "$2y$10\$wpBkEOp9Cq89XuA8cd.oM.HiV02mcLH5BtaDJsUvU2DCrVmgzf/Pi",
            'phone_number' => "0694121593",
            'avatar' => "uploads/avatars/default.png",
            'e_n_s_a_id' => 1
        ]);
    }
}
