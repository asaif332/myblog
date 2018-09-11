@extends('layouts.app')

@section('content')

<div class="card col-md-8 offset-md-2 p-0">
    <div class="card-body bg-light">
        <h2 class="card-title text-center">My profile</h2>
        <form method="post" action="{{ route('users.profile.update') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
      
            <div class="form-group">
                <label for="name">User name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name}}" placeholder="Enter name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email}}" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="avatar">Add a Avatar</label>
                <input type="file" name="avatar" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">New password</label>
                <input type="password" name="password" class="form-control" placeholder="New password">
            </div>

            <div class="form-group">
                <label for="confirm">Confirm password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
            </div>

            <div class="form-group">
                <label for="facebook">Facebook link</label>
                <input type="text" name="facebook" class="form-control" value="{{ $user->profile->facebook}}">
            </div>

            <div class="form-group">
                <label for="youtube">Youtube link</label>
                <input type="text" name="youtube" class="form-control" value="{{ $user->profile->youtube}}">
            </div>

            <div class="form-group">
                <label for="about">About you</label>
                <textarea name="about" rows="5" class="form-control">{{ $user->profile->about }}</textarea>
            </div>

            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-secondary" value="Update profile">
            </div>
        </form>
    </div>
</div>
@endsection