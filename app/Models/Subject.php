<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name','description','status','exam_id'];


    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

}
