<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
 
class Course extends Model
{
    protected $fillable = [
        'id', 'title',  
    ];

    public function courses(){
        return $this->belongsToMany('App\User'); //this course model belongs to many users
    }

    public function instructors()
    {
        return $this->belongsToMany(User::class, 'course_user');

    }
    
     /**
     * Defined scopeOfInstructor
     *This is a function of model course
     * I have modified the query with a relationship so if I am not an admin then I will return the courses only by instructor (assigned by admin) using user_id 
     *The relationship is belongs to many instructors with User class 
     *Utilising this in CoursesController
     */
    public function scopeOfInstructor($query)
    {
        if (!Auth::user()->isAdmin()) {
            return $query->whereHas('instructors', function($q) {
                $q->where('user_id', Auth::user()->id);
            });
        }
        return $query;
    }
}


