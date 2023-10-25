<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    use HasFactory;

    protected $table = 'fct_survey_questions';

    protected $fillable = [
        'survey_id',
        'status_id',
        'question_type_id',
        'question',
        'deleted_at',
    ];

    public function choices()
    {
        return $this->hasMany(SurveyQuestionChoice::class, 'survey_question_id')
        ->where('status_id', STATUS_ACTIVE);
    }

    public function questionType()
    {
        return $this->belongsTo(QuestionType::class, 'question_type_id');
    }
}
