@extends('layouts.app')

@section('content')

<div class="card col-md-8 offset-md-2 p-0">
    <div class="card-body bg-light">
        <h2 class="card-title text-center">Edit Tag</h2>
        <form method="post" action="{{ route('tags.update' , ['id' => $tag->id]) }}">
            {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
                <label for="name">Tag name</label>
                <input type="text" name="tag" class="form-control" value="{{ $tag->tag }}">
            </div>

            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-secondary" value="Edit Tag">
            </div>
        </form>
    </div>
</div>

@endsection