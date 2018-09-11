@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2 class="">Posts</h2><hr>
    @if($posts->count() > 0)

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
        <thead>
            <th> Image </th>
            <th> Title </th>
            <th> Actions</th>
        </thead>
        <tbody class="">
            @foreach($posts as $post)
            <tr>
                <td> <img src="{{ $post->featured }}" alt="{{ $post->title }}" width="50px" height="50px"> </td>
                <td> {{ $post->title }}</td>
                <td>
                    <a class="btn btn-sm btn-secondary" href="{{ route('posts.edit' , ['id' => $post->id]) }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-sm btn-secondary" onclick="$('#post-delete{{$post->id}}').submit();" href="#" data-toggle="tooltip" title="Move to trash">
                        <i class="fas fa-trash"></i>
                    </a>
                    <form method="post" id="post-delete{{$post->id}}" action="{{ route('posts.destroy' , ['id' => $post->id]) }}">
                        {{ csrf_field() }}
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>

    @else
    <br><br>
    <h2> No posts published</h2>
    @endif
    
</div>


@endsection