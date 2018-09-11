@if(session()->has('error'))

<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session()->get('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


@if($errors->any())

<div class="alert alert-danger alert-dismissible fade show" role="alert">
    @foreach($errors->all() as $error)
    <p class="p-0 mb-0">{{ $error }}</p>
    @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif