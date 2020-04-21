@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">View Course: {{ $course->name }}</div>
                    <div class="card-body">
                        <div class="form-group">
                            <table class="table">
                                <tbody>
                                
                                    <tr>
                                        <th>Course ID</th>
                                        <td>{{ $course->id }}</td>
                                    </tr>

                                    <tr>
                                        <th>Title</th>
                                        <td>{{ $course->title }}</td>
                                        
                                    </tr>   

                                    <tr>
                                        <th>Instructor</th>
                                        <td> 
                                            @foreach($course->instructors as $key => $item)
                                                {{ $item->name }}
                                            @endforeach 
                                        </td> 
                                    </tr>  

                                </tbody>
                            </table>
                        <div class="form-group">
                            <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">
                                Back to list
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                                  
@endsection
                


