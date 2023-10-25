<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyComment extends Model
{
    use HasFactory;

    protected $table = "fct_survey_comment";

    protected $fillable = [
        'survey_id',
        'comment_id',
        'user_id',
        'comment',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class, 'survey_id');
    }
}
