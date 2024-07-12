<form action="{{ route('posts.comment.store', ['post' => $post]) }}" method="POST" class="mt-3 mb-2">
    @csrf
    <div class="form-group">
        <input id="x" type="hidden" name="comment"
               value="{{ old('content') }}">
        <trix-editor input="x" id="comment"></trix-editor>
    </div>
    <button type="submit" class="btn btn-primary mt-3">{{ __('Submit Comment') }}</button>
</form>
