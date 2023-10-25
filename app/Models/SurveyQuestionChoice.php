<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestionChoice extends Model
{
    use HasFactory;

    protected $table = 'fct_survey_choices';

    protected $fillable = [
        'survey_question_id',
        'status_id',
        'choice',
    ];

}
