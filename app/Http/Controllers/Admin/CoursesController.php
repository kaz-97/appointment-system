<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\User;
use App\Course;
use App\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
 

class CoursesController extends Controller
{
    public function __construct()
    { 
        //calling auth middleware to check whether user is logged in, if no logged in user they will be redirected to login page
        $this->middleware('auth');
    }

    public function index()
    {

        $courses = Course::ofInstructor()->get();
        return view('admin.course.index', compact('courses')); //pass data down to view
    }

    public function create()
    {  

        $instructors = User::whereHas('role', function ($query) { 
            $query->where('role_id', 2); })->select('id','name')->get();  //defining instructor variable to call in create.blade.php. Followed by specifying that only users with role_id:2 can be viewed in the select form by looping through the pivot table to check each role_id 

        return view('admin.course.create', compact('instructors')); //passing instructor to view
    }

    public function store(Request $request)
    {
        $course = Course::create($request->all()); //request all the data fields to store in DB
        $course->instructors()->sync($request->input('instructors', [])); //input method retrieves all of the input values as an array

        if($course->save()){
            $request->session()->flash('success', 'The course ' . $course->title . ' has been created successfully.');
        }else{
            $request->session()->flash('error', 'There was an error creating the course');
        }

        return redirect()->route ('admin.courses.index');
    }

    public function destroy(Course $course)
    {

        $course->delete();
        return redirect()->route('admin.courses.index');
    }

    public function edit(Course $course)
    {

        $instructors = User::whereHas('role', function ($query) { 
            $query->where('role_id', 2); })->get()->pluck('name');
        
        //return view('admin.course.edit', compact('instructors'));

        return view('admin.course.edit', compact('instructors'))->with([
             'course' => $course
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $course->update($request->all());
       
        if ($course->save()){
            $request->session()->flash('success', $course->title . ' has been updated successfully.');
        }else{
            $request->session()->flash('error', 'There was an error updating ' . $course->title);
        }
        return redirect()->route('admin.courses.index');
    }

    public function show(Course $course)
    {
        return view('admin.course.show', compact('course'));
    }

}


