@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <p>
            
                <a href="{{ route('admin.services.create') }}"><button type="button" class="btn btn-success">Create a Meeting Option</button></a>
            
            </p>

            <div class="card">
                <div class="card-header">
                    <h5>Type of Meetings</h5>
                </div>
                
                <div class="card-body">


                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr> 
                            @if (Auth::user()->isAdmin())
                                <th>ID</th>
                            @endif
                            <th>Name</th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>  
                            @if (count($services) > 0)
                                @foreach ($services as $service) 
                                <tr>
                                    @if (Auth::user()->isAdmin())
                                        <th scope="row">{{ $service->id }}</th>
                                    @endif
                                    <td>{{ $service->name}}</td>

                                    <td>
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.services.edit', $service->id) }}">
                                            Edit
                                        </a>
                                    </td>

                                
                                </tr>    
                                @endforeach
                                @else
                            <tr>
                                <td colspan="12">No meeting options have been created yet.</td>
                            </tr>
                            @endif
                      </table> 
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
