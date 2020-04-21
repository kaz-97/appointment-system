<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles'; //specifies which table to use for the Role Model

    protected $fillable = [
        'title', 'created_at', 'updated_at',
    ];

    public function users(){
        return $this->belongsToMany('App\User'); //this role model belongs to many users & also add to user model
    }
}
