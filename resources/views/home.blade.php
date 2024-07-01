@extends('layouts.base')

@section('page.title', 'Home')

@section('content')

    <x-alerts/>

    <div class="container mt-4">
        <h1>Recently added posts</h1>
        @if($posts->isEmpty())
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>There are no posts yet. <a href="{{ route('user.posts.create') }}">Add post</a> be first! </p>
                </div>
            </div>
        @else
            <div class="row mt-xxl-5">
                @foreach($posts as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @if($post->image)
                                <img src="{{ Storage::url('post-images/'.$post->image) }}" class="card-img-top"
                                     alt="Post Image">
                            @else
                                <img src="https://loremflickr.com/320/240/all?random={{ random_int(1,100) }}"
                                     class="card-img-top" alt="Post Image">
                            @endif
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0 w-50">{{ Str::limit($post->title, 30) }}</h5>
                                    <span class="text-muted">{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="card-text mt-2">{!! format_str($post->content, 150); !!}</p>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{ $posts->links() }}
            </div>
        @endif
    </div>

@endsection
