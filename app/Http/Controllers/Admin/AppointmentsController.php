<?php

namespace App\Http\Controllers\Admin;

use App\Meeting;
use App\User;
use App\Appointment;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;

class AppointmentsController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
 
        return view('admin.appointments.index', compact('appointments'));
    }
 
    public function create()
    {
          $students = User::whereHas('role', function ($query) { 
              $query->where('role_id', 3); 
          })->select('id','name')->get(); 
        
         $services = \App\Service::get();
         $users = \App\User::get();

        return view('admin.appointments.create', compact('users', 'students', 'services'));
    }

    public function store(Request $request)
    {
        $instructor = \App\User::find($request->instructor_id);
		$meetings = \App\Meeting::where('instructor_id', $request->instructor_id)->whereDay('date', '=', date("d", strtotime($request->date)))->whereTime('start_time', '<=', date("H:i", strtotime("".$request->starting_hour.":".$request->starting_minute.":00")))->whereTime('finish_time', '>=', date("H:i", strtotime("".$request->finish_hour.":".$request->finish_minute.":00")))->get();
		if(!$instructor->provides_service($request->service_id)) return redirect()->back()->withErrors("This instructor doesn't provide your selected service")->withInput();
        if($working_hours->isEmpty()) return redirect()->back()->withErrors("This instructor isn't available at your selected time")->withInput();
		$appointment = new Appointment;
		$appointment->student_id = $request->student_id;
		$appointment->instructor_id = $request->instructor_id;
		$appointment->start_time = "".$request->date." ".$request->starting_hour .":".$request->starting_minute.":00";
		$appointment->finish_time = "".$request->date." ".$request->finish_hour .":".$request->finish_minute.":00";
		$appointment->comments = $request->comments;
		$appointment->save();


        return redirect()->route('admin.appointments.index');
    }

    public function show(Appointment $appointment)
    {
        //
    }

    public function edit(Appointment $appointment)
    {
        //
    }

    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    public function destroy(Appointment $appointment)
    {
        //
    }
}
