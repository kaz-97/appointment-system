@extends('layouts.app')
@section('content')

<div class="container">
        <div class="row justify-content-center">
                <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Edit User: {{ $user->name }}</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label class="required" for="name">User ID</label>
                                            <input id="user" type="text" class="form-control @error('user') is-invalid @enderror" name="user" value="{{ $user->id }}" required autofocus>
                                            @error('user')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                
                                    <div class="form-group">
                                        <label class="required" for="name">Name</label>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="required"for="email">Email</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                
                                    <div class="form-group">
                                        <label for="courses">Course</label>
                                        @foreach($courses as $course)
                                            <div class="form-check">
                                                <input type="checkbox" name="courses[]" value="{{ $course->id }}"
                                                @if($user->courses->pluck('id')->contains($course->id)) checked @endif>
                                                <label>{{ $course->title}}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="form-group">
                                        <label for="roles">Role</label>
                                        @foreach($roles as $role)
                                            <div class="form-check">
                                                <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                                @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                                <label>{{ $role->role_name}}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="form-group">
                                        <label for="roles">If Instructor, please select if meetings will be availabe to students:</label>
                                        @foreach($services as $service)
                                            <div class="form-check">
                                                <input type="checkbox" name="services[]" value="{{ $service->id }}"
                                                @if($user->services->pluck('id')->contains($service->id)) checked @endif>
                                                <label>{{ $service->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-danger" type="submit">
                                            Save
                                        </button>
                                        <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">
                                            Cancel
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
        </div>
</div>                                  
@endsection
                
  