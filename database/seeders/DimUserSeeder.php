<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DimUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dim_users')->insert([
            [
                // Admin Credentials
                'id' => 1,
                'role_id' => 1,
                'name' => 'Admin',
                'username' => 'superadmin',
                'email' => 'admin@example.com',
                'phone_number' => '09398969415',
                'password' => Hash::make('admin1234'),
                'status_id' => 1,
            ],
        ]);

        DB::table('fct_user_details')->insert([
            [
                // Admin Credentials
                'id' => 1,
                'user_id' => 1,
               
            ],
        ]);


        DB::table('points')->insert([
            [
                // Admin Credentials
                'id' => 1,
                'user_id' => 1,
                'points' => 0,
            ],
        ]);
    }
}
