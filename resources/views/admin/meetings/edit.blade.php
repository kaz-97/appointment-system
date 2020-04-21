@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Meeting Availability: {{ $meeting->name }}</div> 

                <div class="card-body">

                        <form method="POST" action="{{ route("admin.meetings.update", [$meeting->id]) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
            
                                <div class="form-group">
                                    <label class="required" for="name">Date:</label>
                                        <input id="date" type="text" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ $meeting->date }}" required autofocus>
                                </div> 

                                 <div class="form-group">
                                    <label class="required" for="name">Start Time:</label>
                                        <input id="start_time" type="text" class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{ $meeting->start_time }}" required autofocus>
                                </div> 

                                 <div class="form-group">
                                    <label class="required" for="name">Finish Time:</label>
                                        <input id="finish_time" type="text" class="form-control @error('finish_time') is-invalid @enderror" name="finish_time" value="{{ $meeting->finish_time }}" required autofocus>
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
