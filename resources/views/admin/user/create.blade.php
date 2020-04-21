@extends('layouts.app')
@section('content')

<div class="container">
        <div class="row justify-content-center">
                <div class="col-md-8">
                        
                        <div class="card">
                            <div class="card-header">Create User</div>
                            <div class="card-body">
                                    <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label class="required" for="name">Name</label>
                                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                                                    @if($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                                    @endif  
                                        </div>

                                        <div class="form-group">
                                            <label class="required" for="email">Email</label>
                                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email') }}" required>
                                                @if($errors->has('email'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('email') }}
                                            </div>
                                                @endif
                                        </div>
                
                                        <div class="form-group">
                                            <label for="courses">Course</label>
                                            @foreach($courses as $course)
                                                <div class="form-check">
                                                    <input type="checkbox" name="courses[]" value="{{ $course->id }}">
                                                    <label>{{ $course->title}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                                                            
                                        <div class="form-group">
                                            <label for="roles">Role</label>
                                            @foreach($roles as $role)
                                                <div class="form-check">
                                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                                                    <label>{{ $role->role_name}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="required" for="password">Password</label>
                                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                                                @if($errors->has('password'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                            </div>
                                                @endif
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