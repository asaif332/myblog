@extends('layouts.app')

@section('content')

<div class="card col-md-8 offset-md-2 p-0">
    <div class="card-body bg-light">
        <h2 class="card-title text-center">Create a post</h2>
        <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Add a title">
            </div>

            <div class="form-group">
                <label for="category">Select a Category</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <label for="Tag">Select tags </label>
            @foreach($tags as $tag)
            <div class="form-group form-check mb-0">
                <input type="checkbox" class="form-check-input" name="tag[]" value="{{$tag->id}}">
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
                <textarea name="content" id="summernote" class="form-control" rows="5"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-secondary" value="Share">
            </div>
        </form>
    </div>
</div>


@endsection


@section('styles')
<!-- Include Editor style. -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
<!-- Include Editor JS files. -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1//js/froala_editor.pkgd.min.js"></script>
    <script>
        $(function() {
          $('textarea').froalaEditor()
        });
    </script>
@endsection