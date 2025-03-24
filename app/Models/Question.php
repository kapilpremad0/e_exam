<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['option_a','option_b','option_c','option_d','correct_answer','name','level_id','status'];
}
