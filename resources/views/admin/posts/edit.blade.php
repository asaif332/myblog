@extends('layouts.app')

@section('content')

<div class="card col-md-8 offset-md-2 p-0">
    <div class="card-body bg-light">
        <h2 class="card-title text-center">Edit post</h2>
        <form method="post" action="{{ route('posts.update' , ['id' => $post->id]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{ $post->title }}" class="form-control" placeholder="Add a title">
            </div>

            <div class="form-group">
                <label for="category">Select a Category</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option {{ $post->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <label for="Tag">Select tags </label>
            @foreach($tags as $tag)
            <div class="form-group form-check mb-0">
                <input type="checkbox" class="form-check-input" name="tag[]" value="{{$tag->id}}" 
                @foreach($post->tags as $t)
                    @if($t->id == $tag->id)
                    checked
                    @endif
                @endforeach>
                <label class="form-check-label">{{ $tag->tag }}</label>
            </div>
            @endforeach
            <br>

            <div class="form-group">
                <label for="featured">Featured Image</label>
                <input type="file" name="featured" class="form-control">
            </div>
            <div class="form-group">
                <label for="title">Content</label>
                <textarea name="content" class="form-control" rows="5">{{ $post->content }}</textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-secondary" value="edit">
            </div>
        </form>
    </div>
</div>

@endsection