<?php

namespace App\Http\Controllers\Admin;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $service = Service::create($request->all());
        
        if($service->save()){
            $request->session()->flash('success', 'The meeting option has been created successfully.');
        }else{
            $request->session()->flash('error', 'There was an error creating the meeting option');
        }

        return redirect()->route('admin.services.index');
    }

    public function show(Service $service)
    {
        //
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $service->update($request->all());
       
        if ($service->save()){
            $request->session()->flash('success', 'The meeting option: ' . $service->name . ' has been updated successfully.');
        }else{
            $request->session()->flash('error', 'There was an error updating the meeting option' . $service->name);
        }
        return redirect()->route('admin.services.index');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index');
    }
}
