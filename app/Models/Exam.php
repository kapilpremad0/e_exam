<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['name','image','status','trending','description'];


    public function getImageAttribute()
    {
        $value = $this->attributes['image'] ?? null;

        if ($value) {
            return asset('public/storage/'.$value); // Assuming images are stored in storage/app/public/
        } else {
            return asset('public/default.png'); // Adjust the path if needed
        }
    }

    public function scopeActive($query)
    {
        return $query->where('status',1);
    }


    public function subjects()
    {
        return $this->hasMany(Subject::class, 'exam_id', 'id');
    }

    

}
