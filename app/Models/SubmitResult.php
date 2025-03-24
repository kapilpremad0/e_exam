<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmitResult extends Model
{
    protected $fillable = ['user_id','level_id','total_question','correct_anster'];

    public function laval()
    {
        return $this->belongsTo(Level::class, 'level_id', 'id')->with('subject','exam');
    }


}
