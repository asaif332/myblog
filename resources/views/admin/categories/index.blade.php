@extends('layouts.app')

@section('content')
<div class="container col-md-6 text-center">
    <h2 class="">Categories</h2><hr>
    @if($categories->count() > 0)
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
        <thead>
            <th> category name </th>
            <th> actions</th>
        </thead>
        <tbody class="">
            @foreach($categories as $category)
            <tr>
                <td> {{ $category->name }}</td>
                <td>
                    <a class="btn btn-sm btn-secondary" href="{{ route('categories.edit' , ['id' => $category->id]) }}"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-sm btn-danger" onclick="
                        var x = confirm('Do you want to delete category?');
                        if(x){
                            $('#category-delete{{$category->id}}').submit();
                        }
                    " 
                    href="#"><i class="fas fa-trash"></i></a>
                    <form method="post" id="category-delete{{$category->id}}" action="{{ route('categories.destroy' , ['id' => $category->id]) }}">
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
    <h2> No categories yet </h2>

    @endif

    
</div>


@endsection