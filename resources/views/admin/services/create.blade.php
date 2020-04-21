@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Meeting Option</div>
                <div class="card-body">
                   
                        <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                    <label class="required" for="name">Name:</label>
                                    <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
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