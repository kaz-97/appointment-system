@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Availability</div>
                <div class="card-body">
                   
                        <form method="POST" action="{{ route('admin.meetings.store') }}" enctype="multipart/form-data">
                            @csrf 

                            <div class="form-group">
                                <input type="hidden" name="instructor_name" value="{{ Auth::user()->name }}">
                            </div>
                            
                            <div class="form-group">
                                <label class="required" for="name">Select Instructor:</label>
								<select id="instructor_id" name="instructor_id" class="form-control select2" required>
									<option value="">Please select</option>
									@foreach($instructors as $instructor)
									<option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
									@endforeach
								</select>
                            </div>

                            <div class="form-group">
                                    <label class="required" for="date">Date:</label>
                                    <input class="form-control date hasDatePicker" type="text" autocomplete="off" name="date" id="date" placeholder="YY-MM-DD" required>
                            </div>

                            <div class="form-group">
                                    <label class="required" for="start_time">Start Time:</label>
                                    <input class="form-control timepicker" type="text" name="start_time" autocomplete="off" id="start_time" value="{{ old('start_time', '') }}" placeholder="HH:mm" required>
                            </div>

                            <div class="form-group">
                                    <label class="required" for="finish_time">Finish Time:</label>
                                    <input class="form-control timepicker" type="text" name="finish_time" autocomplete="off" id="finish_time" value="{{ old('finish_time', '') }}" placeholder="HH:mm" required>
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

@section('javascript')


@endsection



