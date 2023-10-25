<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DimPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dim_plans')->insert([
            [
                'id' => 1,
                'name' => '3_months',
                'text' => '3 Months',
                'price' => 300,
                'duration_month' => 3,
                'status_id' => 1
            ],
            [
                'id' => 2,
                'name' => '6_months',
                'text' => '6 Months',
                'price' => 500,
                'duration_month' => 6,
                'status_id' => 1
            ],
            [
                'id' => 3,
                'name' => '12_months',
                'text' => '12 Months',
                'price' => 999,
                'duration_month' => 12,
                'status_id' => 2
            ],
        ]);
    }
}
