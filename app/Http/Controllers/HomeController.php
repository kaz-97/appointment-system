<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');

         //Attach a admin role to ADMIN: 
            //ROLES TO SET 
                //user_id 1 (ADMIN) = admin (role_id 1)
         
        //Uncomment the three lines of code below and run:
            //$user = User::find(1);
            //$user->roles()->attach(1);
            //dd($user->roles);
    }
}
