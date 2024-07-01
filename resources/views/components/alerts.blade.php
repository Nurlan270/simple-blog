@if(session('status') && ! session('error'))
    <div class="alert alert-success text-center">
        {{ session('status') }}
    </div>
@elseif(session('status') && session('error'))
    <div class="alert alert-danger text-center">
        {{ session('status') }}
    </div>
@elseif($errors->any())
    @foreach($errors->all() as $message)
        <div class="alert alert-danger text-center">
            {{ $message }}
        </div>
    @endforeach
@endif

@if($msg = session('auth'))
    <div class="alert alert-success text-center">
        {{ $msg }}
    </div>
@endif

@if($msg = session('post'))
    <div class="alert alert-success text-center">
        {{ $msg }}
    </div>
@endif
