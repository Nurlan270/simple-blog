@if($msg = request()->old('success'))
    <div class="alert alert-success text-center py-0">
        <h5 class="pb-0 py-2">{{ $msg }}</h5>
    </div>
@endif

@if($msg = request()->old('error'))
    <div class="alert alert-danger text-center py-0">
        <h5 class="pb-0 py-2">{{ $msg }}</h5>
    </div>
@endif
