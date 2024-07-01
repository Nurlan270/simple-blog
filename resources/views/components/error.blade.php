@if($errors->has('authError'))
    <div class="bg-danger-subtle px-3 py-2 rounded-1">
        {{ $msg = $errors->first() ?? null }}
    </div>
@endif
