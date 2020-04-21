<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['start_time', 'finish_time', 'comments', 'student_id', 'instructor_id'];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
	
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }	
}
