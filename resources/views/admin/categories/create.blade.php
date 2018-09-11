@extends('layouts.app')

@section('content')

<div class="card col-md-8 offset-md-2 p-0">
    <div class="card-body bg-light">
        <h2 class="card-title text-center">Create a Category</h2>
        <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Category name</label>
                <input type="text" name="name" class="form-control" placeholder="Add a category">
            </div>

            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-secondary" value="Add category">
            </div>
        </form>
    </div>
</div>

@endsection
