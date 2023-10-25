<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DimStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dim_status')->insert([
            [
                'id' => 1,
                'code' => 'active',
                'text' => 'Active',
            ],
            [
                'id' => 2,
                'code' => 'inactive',
                'text' => 'Inactive',
            ],
        ]);
    }
}
