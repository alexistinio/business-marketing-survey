<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DimQuestionTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dim_question_type')->insert([
            [
                'name' => 'multiple_choice_single',
                'text' => 'Multiple Choice (Single Answer)',
            ],
            [
                'name' => 'multiple_choice_multiple',
                'text' => 'Multiple Choice (Multiple Answer)',
            ],
        ]);
    }
}
