@extends('layouts.app')

@section('content')

<div class="card col-md-8 offset-md-2 p-0">
    <div class="card-body bg-light">
        <h2 class="card-title text-center">Edit Category</h2>
        <form method="post" action="{{ route('categories.update' , ['id' => $category->id]) }}">
            {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
                <label for="name">Category name</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}" placeholder="Add a category">
            </div>

            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-secondary" value="Edit category">
            </div>
        </form>
    </div>
</div>

@endsection