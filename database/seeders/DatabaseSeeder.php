<?php

namespace Database\Seeders;

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
            DimStatusSeeder::class,
            DimSubscriptionStatus::class,
            DimRoleSeeder::class,
            DimPlanSeeder::class,
            DimCategorySeeder::class,
            DimUserSeeder::class,
            DimPermissionSeeder::class,
            DimQuestionTypes::class,
            SurveySeeder::class,
     
        ]);
    }
}
