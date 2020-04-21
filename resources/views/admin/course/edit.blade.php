@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Course: {{ $course->title }}</div> 

                <div class="card-body">

                        <form method="POST" action="{{ route("admin.courses.update", [$course->id]) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label class="required" for="name">Course ID</label>
                                        <input id="course" type="text" class="form-control @error('course') is-invalid @enderror" name="course" value="{{ $course->id }}" required autofocus>
                                        @error('course')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
            
                                <div class="form-group">
                                    <label class="required" for="name">Title</label>
                                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $course->title }}" required autofocus>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    @can('create_courses')
                                            {!! Form::label('Instructor', 'Instructor', ['class' => 'control-label']) !!}
                                            {!! Form::select('Instructor[]', $instructors, Request::get('Instructor'), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!} 
                                            @if($errors->has('Instructor'))
                                                {{ $errors->first('Instructor') }}
                                            @endif
                                     @endcan
                                </div>

                                
                    @csrf 
                    {{ method_field('PUT') }}
                    
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </form> 
            </div>
        </div>
    </div>
</div>
@endsection
