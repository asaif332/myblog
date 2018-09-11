@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row text-center">
       <div class="col-md-3 col-sm-6">
            <div class="card">
                <div class="card-header bg-info text-white">Posts</div>
                <div class="card-body">
                    <p>{{ $posts_count }}</p>
                </div>
            </div>
        </div>

       <div class="col-md-3 col-sm-6">
            <div class="card">
                <div class="card-header bg-warning text-white">Trashed Posts</div>
                <div class="card-body">
                    <p>{{ $trashed_posts_count }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
           <div class="card">
               <div class="card-header bg-secondary text-white">Categories</div>
               <div class="card-body">
                   <p>{{ $categories_count }}</p>
               </div>
           </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card">
                <div class="card-header bg-success text-white">Users</div>
                <div class="card-body">
                    <p>{{ $users_count }}</p>   
                </div>
            </div>
        </div>
   </div>
</div>
@endsection
