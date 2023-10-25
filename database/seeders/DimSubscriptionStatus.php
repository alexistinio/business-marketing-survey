<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DimSubscriptionStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dim_subscription_status')->insert([
            [
                'id' => '1',
                'name' => 'active',
                'text' => 'Active',
            ],
            [
                'id' => '2',
                'name' => 'expired',
                'text' => 'Expired',
            ],
            [
                'id' => '3',
                'name' => 'cancelled',
                'text' => 'Cancelled',
            ],
            [
                'id' => '4',
                'name' => 'pending',
                'text' => 'Pending'
            ],
        ]);
    }
}
