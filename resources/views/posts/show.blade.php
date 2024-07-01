@extends('layouts.base')

@section('page.title', $post->title)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-4 shadow-lg">
                    @if($post->image)
                        <img src="{{ Storage::url('post-images/'.$post->image) }}" class="card-img-top"
                             alt="Post Image">
                    @else
                        <img src="https://loremflickr.com/320/190/all" class="card-img-top"
                             alt="Post Image">
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="card-title mb-0 text-break">{{ $post->title }}</h3>
                            <small class="text-muted">{{ $date .' at '. $time }}</small>
                        </div>
                        <p class="card-text">{!! $post->content !!}</p>
                        <div class="d-flex justify-content-end">
                            <small class="text-muted">By {{ $post->author }}</small>
                        </div>
                    </div>
                </div>
                <a href="{{ route('home') }}" class="btn btn-secondary">Back to Posts</a>
            </div>
        </div>
    </div>
@endsection
