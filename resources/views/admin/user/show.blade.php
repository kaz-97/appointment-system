@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">View User: {{ $user->name }}</div>
                    <div class="card-body">
                        <div class="form-group">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>User ID</th>
                                        <td>{{ $user->id }}</td>
                                    </tr>

                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>

                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>

                                    <tr>
                                        <th>Role</th>
                                        <td>
                                            {{ implode (', ', $user->roles()->pluck('role_name')->toArray()) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Course</th>
                                        <td>
                                            {{ implode ($user->courses()->pluck('title')->toArray()) }}
                                        </td>
                                    
                                </tbody>
                            </table>
                        <div class="form-group">
                            <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                                  
@endsection
                


