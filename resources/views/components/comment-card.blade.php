@php use App\Models\User; @endphp
@foreach($comments as $comment)
    <div class="card mb-3" id="{{ $comment->id }}">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title">{{ User::query()->find($comment->user_id)->name }} <a href="#{{ $comment->id }}">#</a></h5>
                <h6 class="card-subtitle text-muted">{{ $comment->created_at->diffForHumans() }}</h6>
            </div>
            <p class="card-text">{!! format_str($comment->comment) !!}</p>
            @can('destroy', $comment)
                <div class="d-flex justify-content-end">
                    <form
                        action="{{ route('posts.comment.destroy', ['post' => $post->id, 'comment' => $comment->id]) }}"
                        method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-2">
                            <i class="bi bi-trash"></i>
                            {{ __('Delete') }}
                        </button>
                    </form>
                </div>
            @endcan
        </div>
    </div>
@endforeach
