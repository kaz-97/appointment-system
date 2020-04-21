@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <p>
                <a href="{{ route('admin.courses.create') }}"><button type="button" class="btn btn-success">Create Course</button></a>
            </p>
            <div class="card">
                <div class="card-header">
                    <h5>Courses</h5>
                </div>
                
                <div class="card-body">


                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr> 
                            @if (Auth::user()->isAdmin())
                            <th>ID</th>
                            @endif
                            <th>Course Title</th>
                            @if (Auth::user()->isAdmin())
                                <!-- <th>Module Director</th> // got rid of module director as there is a relationship error assigning too many users to the course and displaying within the column, to rectify I have assigned instructors to their own course (many students can be assigned to a course and therefore id is filtered through to define their course.. and they do not need assigned to individual courses --> 
                            @endif
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>  
                            @if (count($courses) > 0)
                                @foreach ($courses as $course) 
                                <tr>
                                @if (Auth::user()->isAdmin())
                                    <th scope="row">{{ $course->id }}</th>
                                @endif
                                    <td>{{ $course->title}}</td>
                                
                                @can('create_courses')
                                <!-- <td>
                                    @foreach ($course->instructors as $individualInstructor)
                                        {{ $individualInstructor->name }}
                                    @endforeach
                                </td> -->
                                @endcan

   

                                <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.courses.edit', $course->id) }}">
                                        Edit
                                    </a>
                                </td>

                                <td>
                                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Confirm delete?');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                    </form>
                                </td>
                                </tr>    
                                @endforeach
                                @else
                            <tr>
                                <td colspan="12">No courses are available. Please contact your administrator.</td>
                            </tr>
                            @endif
                      </table> 
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-2 col-lg-2">
                <div class="list-unstyled">
                    <a href=""class="list-group-item">Courses</a>
                    <a href=""class="list-group-item">Modules</a>
                </div>
        </div> -->
    </div>
</div>
@endsection
