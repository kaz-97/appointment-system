<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = ['date', 'start_time', 'finish_time', 'instructor_name', 'instructor_id']; 

    public function user() //instructor
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
