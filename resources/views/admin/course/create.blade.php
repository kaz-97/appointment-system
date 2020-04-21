@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Course</div>
                <div class="card-body">
                   
                        <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                    <label class="required" for="name">Course Title</label>
                                    <input class="form-control" type="text" name="title" id="id" value="{{ old('title', '') }}" required>
                                    @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div> 
                                @endif
                            </div>

                            
                            <div class="form-group {{ $errors->has('instructors') ? 'has-error' : '' }}">
                                <label class="required" for="name">Instructors</label>
                                    <select class="form-control select2" name="instructors[]" id="instructors" multiple>
                                    @foreach($instructors as $id => $instructor)
                                        <option value="{{ $instructor->id }}" {{ in_array($id, old('instructors', [])) ? 'selected' : '' }}>{{ $instructor->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                Save
                            </button>
                        </div>
                    </div>
                    
                    </form>
                </div>
            </div>
            @endsection
