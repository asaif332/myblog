@extends('layouts.app')

@section('content')
<div class="container col-md-8 text-center">
    <h2 class="">Users</h2><hr>
    @if($users->count() > 0)
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
        <thead>
            <th> Avatar </th>
            <th> User Name </th>
            <th> Permissions </th>
            <th> Actions</th>
        </thead>
        <tbody class="">
            @foreach($users as $user)
            <tr>
                <td> <img src="{{ asset($user->profile->avatar) }}" alt="Avatar" width="60px" height="60px" style="border-radius:50%"> </td>
                <td> {{ $user->name }}</td>
                <td>
                    @if($user->admin)
                    <a href="{{ route('users.not.admin' , ['id' => $user->id]) }}" class="btn btn-sm btn-danger">remove admin</a>
                    @else
                    <a href="{{ route('users.admin' , ['id' => $user->id]) }}" class="btn btn-sm btn-success">make admin</a>
                    @endif
                </td>
                <td>
                    @if(Auth :: id() !== $user->id)
                    <a class="btn btn-sm btn-danger" onclick="
                        var x = confirm('Do you want to delete user?');
                        if(x){
                            $('#user-delete{{$user->id}}').submit();
                        }
                    " 
                    href="#"><i class="fas fa-trash"></i></a>
                    <form method="post" id="user-delete{{$user->id}}" action="{{ route('users.destroy' , ['id' => $user->id]) }}">
                        {{ csrf_field() }}
                        @method('DELETE')
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>

    @else
    <br><br>
    <h2> No users </h2>

    @endif

    
</div>


@endsection