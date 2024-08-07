@extends('layouts.base')

@section('page.title', __('My Posts'))

@section('content')

    <x-alerts/>

    <div class="container my-4">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center mb-4">
                <h1>{{ __('My Posts') }}</h1>
                <span class="badge badge-primary px-2 py-2">{{ __('Total Posts') }}: {{ $posts->count() }}</span>
            </div>
        </div>

        @if($posts->isEmpty())
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>{{ __('You have no posts yet.') }} <a href="{{ route('user.posts.create') }}">{{ __('Add') }}</a> {{ __('your first post') }}</p>
                </div>
            </div>
        @else
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-12 mb-4">
                        <div class="card shadow-sm rounded">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <a href="{{ route('posts.show', $post->id) }}">
                                        @if($post->image)
                                            <img src="{{ Storage::url('post-images/'.$post->image) }}"
                                                 class="card-img-top"
                                                 alt="Post Image">
                                        @else
                                            <img
                                                src="https://loremflickr.com/320/240/all?random={{ random_int(1,100) }}"
                                                class="card-img-top" alt="Post Image">
                                        @endif
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <a href="{{ route('posts.show', $post->id) }}">
                                                    <h5 class="card-title mb-2">{{ $post->title }}</h5>
                                                </a>
                                                <div class="d-flex justify-content-between">
                                                    <p class="card-text text-muted pe-4">{{ $post->created_at->translatedFormat('F j, Y') }}</p>
                                                    <p class="card-text text-muted">
                                                        <i class="bi bi-eye-fill"></i>
                                                        {{ $post->views }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn px-1 border-0" type="button"
                                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical h5"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownMenuButton1">
                                                    <li>
                                                        <button class="dropdown-item"
                                                                onclick="location.href='{{ route('user.posts.edit', $post->id) }}';">
                                                            <i class="bi bi-pencil-square pe-2"></i>
                                                            {{ __('Edit') }}
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('user.posts.destroy', $post->id) }}"
                                                              method="POST">
                                                            @method('DELETE')
                                                            @csrf

                                                            <button type="submit"
                                                                    class="dropdown-item text-danger border-0"
                                                                    onclick="location.href='{{ route('user.posts.destroy', $post->id) }}';">
                                                                <i class="bi bi-trash pe-2"></i>
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p class="card-text">{!! format_str($post->content, 690) !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
