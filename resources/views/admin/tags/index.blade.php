@extends('layouts.app')

@section('content')
<div class="container col-md-6 text-center">
    <h2 class="">Tags</h2><hr>
    @if($tags->count() > 0)
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
        <thead>
            <th> Tag Name </th>
            <th> ations</th>
        </thead>
        <tbody class="">
            @foreach($tags as $tag)
            <tr>
                <td> {{ $tag->tag }}</td>
                <td>
                    <a class="btn btn-sm btn-secondary" href="{{ route('tags.edit' , ['id' => $tag->id]) }}"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-sm btn-danger" onclick="
                        var x = confirm('Do you want to delete tag?');
                        if(x){
                            $('#tag-delete{{$tag->id}}').submit();
                        }
                    " 
                    href="#"><i class="fas fa-trash"></i></a>
                    <form method="post" id="tag-delete{{$tag->id}}" action="{{ route('tags.destroy' , ['id' => $tag->id]) }}">
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
    <h2> No tags yet </h2>

    @endif

    
</div>


@endsection