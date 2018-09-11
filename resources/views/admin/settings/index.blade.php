@extends('layouts.app')

@section('content')

<div class="card col-md-8 offset-md-2 p-0">
    <div class="card-body bg-light">
        <h2 class="card-title text-center">Site settings</h2>
        <form method="post" action="{{ route('settings.update') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Site name</label>
                <input type="text" name="site_name" class="form-control" value="{{ $settings->site_name }}">
            </div>

            <div class="form-group">
                <label for="email">Address</label>
                <input type="text" name="address" class="form-control" value="{{ $settings->address }}">
            </div>

            <div class="form-group">
                <label for="email">Contact number</label>
                <input type="text" name="contact_number" class="form-control" value="{{ $settings->contact_number }}">
            </div>


            <div class="form-group">
                <label for="email">Contact email</label>
                <input type="email" name="contact_email" class="form-control" value="{{ $settings->contact_email }}">
            </div>


            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-success" value="update settings">
            </div>
        </form>
    </div>
</div>

@endsection