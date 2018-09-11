@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2 class="">Trashed Posts</h2><hr>
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
                    <a class="btn btn-sm btn-success" href="{{ route('posts.restore' , ['id' => $post->id]) }}">
                        <i class="fas fa-undo"></i>
                    </a>

                    <a class="btn btn-sm btn-danger" href="{{ route('posts.kill' , ['id' => $post->id]) }}">
                        <i class="fas fa-trash"></i>
                    </a>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div> 

    @else
    <br><br>
    <h2> No trashed posts</h2>
    @endif
   
</div>


@endsection