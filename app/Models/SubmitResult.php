<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmitResult extends Model
{
    protected $fillable = ['user_id','level_id','total_question','correct_answer'];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'id')->with('subject','exam');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function getCorrectAnswerPercentageAttribute()
    {
        return ($this->correct_answer / $this->total_question) * 100;
    }
    public function getCorrectAnswerPercentage()
    {
        return $this->correct_answer_percentage;
    }
    public function getCorrectAnswer()
    {
        return $this->correct_answer;
    }


}
