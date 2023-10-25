<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SurveySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('dim_surveys')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'status_id' => 1,
                'title' => "Welcome to Mark IT!",
                'description' => "<p>Mark IT is a Social Media Community for People of Interests &amp; Business Marketing Surveys.</p>",
                'start_date' => "2022-12-03",
                'end_date' => "2022-12-30",
                'is_private' => 0,
            ],
        ]);
    }
}
