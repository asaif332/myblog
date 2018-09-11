@extends('layouts.app')

@section('content')

<div class="card col-md-8 offset-md-2 p-0">
    <div class="card-body bg-light">
        <h2 class="card-title text-center">Create a User</h2>
        <form method="post" action="{{ route('users.store') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">User name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email">
            </div>

            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-secondary" value="Add user">
            </div>
        </form>
    </div>
</div>

@endsection