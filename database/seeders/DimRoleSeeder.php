<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DimRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dim_roles')->insert([
            [
                'id' => 1,
                'name' => 'superadmin',
                'text' => 'Super Admin',
            ],
            [
                'id' => 2,
                'name' => 'premium_user',
                'text' => 'Premium User',
            ],
            [
                'id' => 3,
                'name' => 'user',
                'text' => 'User',
            ],
        ]);
    }
}
