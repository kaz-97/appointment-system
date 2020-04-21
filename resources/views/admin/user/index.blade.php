@extends('layouts.app')
@section('content')

<div class="container">
        <div class="row justify-content-center">
                <div class="col-md-10">
                    <p>
                        <a href="{{ route('admin.users.create') }}"><button type="button" class="btn btn-success">Create User</button></a>
                    </p>
                    
                    <div class="card">
                            <div class="card-header">
                                <h5>Manage Users</h5>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive"> 
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Course</th>
                                        <th>Role</th> 
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $user->id }}</th>
                                            <td>{{ $user->name}}</td>
                                            <td>{{ implode ($user->courses()->pluck('title')->toArray()) }}</td>
                                            <td>{{ implode (', ', $user->roles()->pluck('role_name')->toArray()) }}</td>
                                            <td>
                                                <a class="btn btn-xs btn-secondary" href="{{ route('admin.users.show', $user->id) }}">
                                                    View
                                                </a>
                                            </td>
                                            <td>    
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.users.edit', $user->id) }}">
                                                    Edit
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Confirm delete?');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                            </form>
                                            </td> 
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table> 
                                    </div>
                            </div>
                        </div>
                </div>
        </div>
</div>
@endsection