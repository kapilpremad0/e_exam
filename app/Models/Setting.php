<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key','value'];


    static $general_settings = ['whatsaap_number','email','mobile'];
}
