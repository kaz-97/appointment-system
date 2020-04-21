@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Meeting Option: {{ $service->name }}</div> 

                <div class="card-body">

                        <form method="POST" action="{{ route("admin.services.update", [$service->id]) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                        <label class="required" for="name">ID:</label>
                                            <input id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ $service->id }}" required autofocus>
                                            @error('user')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
            
                                <div class="form-group">
                                    <label class="required" for="name">Name:</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $service->name }}" required autofocus>
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
