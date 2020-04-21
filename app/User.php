<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin() 
    {
        return $this->role()->where('role_id', 1)->first();
    }

    //ROLES

        public function roles()
        {
            return $this->belongsToMany('App\Role');
        }

        public function hasAnyRoles($roles) {
            if($this->roles()->whereIn('role_name', $roles)->first()){
                return true;
            }
            return false;
        }

        public function hasRole($role) {
            if($this->roles()->where('role_name', $role)->first()){
                return true;
            }
            return false;
        }
        
    //Method to pull list of instructors through to select statement 
        public function role()
        {
            return $this->belongsToMany('App\Role');
        }


    //COURSES
        //Method to assign instructor to a course
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_user');
    }


    //Establish relationship with services so user can select service
    public function services()
    {
        return $this->belongsToMany('App\Service');
    }

    public function provides_service($service)
	{
		return $this->services()->where('service_id', $service)->exists();
	}

    public function meetings()
    {
        return $this->hasMany('App\Meeting', 'instructor_id');
    }
}
