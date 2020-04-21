<?php

// Created UsersController which admins can access to allow them to edit users within the system.

namespace App\Http\Controllers\Admin;

use DB;
use Gate;
use App\Role;
use App\User;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /** Display a listing of the resource */
    public function index()
    {        
        $users = User::all();

        return view('admin.user.index', compact('users'));
    }

    /** Method to edit users */
    public function edit(User $user)
    {

        $roles = Role::all();
        $courses =Course::all();

        //
        $services = \App\Service::get()->all();

        return view('admin.user.edit', compact('user', 'roles', 'courses', 'services'));
    }

    /** The show method will enable the admin and instructor to expand the details of the user */
    public function show(User $user)
    {
        $user->load('roles');

        return view('admin.user.show', compact('user'));
    }

    /** Update the specified resource in storage */
    public function update(Request $request, User $user) 
    {
        $user->name = $request->name; //users name is equal to whatever is passed in the request name that is coming from the form
        $user->email = $request->email;
        $user->roles()->sync($request->roles);
        $user->courses()->sync($request->courses);
        //
        $user->services()->sync($request->services);
        
        if ($user->save()){ //lastly, call user save which saves the current user model with the updated fields
                $request->session()->flash('success', $user->name . ' has been updated successfully.');
            }else{
                $request->session()->flash('error', 'There was an error updating ' . $user->name);
            }

        return redirect()->route('admin.users.index');
    }

    /** A create method is requried as users cannot register themselves, they will have to be registered via the admin.*/
    public function create()
    {    
        $roles = Role::all();
        $courses =Course::all();

        //
        $services = \App\Service::get()->all();

        return view('admin.user.create', compact('roles', 'courses', 'services'));
    }

    /** Store function */
    public function store(Request $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->courses()->sync($request->input('courses', []));

        //
        $user->services()->sync($request->input('services', []));


        return redirect()->route('admin.users.index');
    }

    /** Method to delete users */
    public function destroy(User $user)
    {

        $user->roles()->detach();
        $user->delete();

        return redirect(route('admin.users.index'));
    }

    public function GetUsers(Request $request)
	{
		$users = DB::table('users')->join('meetings', function ($join) use ($request) {
			$join->on('users.id', '=', 'meetings.instructor_id')
			->where('meetings.date', '=', $request->date);
		})->get();
		$service = \App\Service::find($request->service_id);
		$html = "";
		$html .= "<div class='form-group'>";
		$html .= "<label class='control-label'>Instructors*</label>";
		$html .= "<ul class='list-inline'>";
		if(is_object($users) && count($users) > 0):
		foreach($users as $user) :
			$html .= "<li><label><input type='radio' name='instructor_id' class='instructor_id' value='".$user->id."'> ".$user->name." (<span class='starting_hour_$user->id'>".date("H", strtotime($user->start_time))."</span>:<span class='starting_minute_$user->id'>".date("i", strtotime($user->start_time))."</span> - <span class='finish_hour_$user->id'>".date("H", strtotime($user->finish_time))."</span>:<span class='finish_minute_$user->id'>".date("i", strtotime($user->finish_time))."</span>)</label></li>";
		endforeach;
		else :
		$html .= "<li>No instructors are available on your selected date</li>";
		endif;
		$html .= "</ul>";
		$html .= "</div>";
		$html .= "</div>";
		return $html;
		
	}
}


