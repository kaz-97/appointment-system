<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Meeting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MeetingsController extends Controller
{
    public function index()
    {
        $meetings = Meeting::all();

        return view('admin.meetings.index', compact('meetings'));
    
    } 

    public function create()
    {
        $instructors = User::whereHas('role', function ($query) { 
            $query->where('role_id', 2); 
        })->select('id','name')->get();

        return view('admin.meetings.create', compact('instructors'));
    }

  
    public function store(Request $request)
    {
        $meeting = Meeting::create($request->all());
        
        if($meeting->save()){
            $request->session()->flash('success', 'Your meeting availability has been uploaded successfully.');
        }else{
            $request->session()->flash('error', 'There was an error uploading your meeting availability');
        }

        return redirect()->route('admin.meetings.index');
    }


    public function show(Meeting $meeting)
    {
        //
    }


    public function edit(Meeting $meeting)
    {
        return view('admin.meetings.edit', compact('meeting'));
    }


    public function update(Request $request, Meeting $meeting)
    {
        $meeting->update($request->all());
       
        if ($meeting->save()){
            $request->session()->flash('success', 'Your meeting availability has been updated successfully.');
        }else{
            $request->session()->flash('error', 'There was an error updating your meeting availability');
        }
        return redirect()->route('admin.meetings.index');
    }

 
    public function destroy(Meeting $meeting)
    {
        //
    }
}
