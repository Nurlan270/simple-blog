@extends('layouts.base')

@section('page.title', $post->title)

@pushonce('css')
    <style>
        .trix-button--icon-heading-1,
        .trix-button--icon-attach,
        .trix-button-group--file-tools,
        .trix-button-group-spacer,
        .trix-button--icon-decrease-nesting-level,
        .trix-button--icon-increase-nesting-level {
            display: none;
        }
    </style>
@endpushonce

@pushonce('trix')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endpushonce

@section('content')
    <x-alerts/>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-4 shadow-lg">
                    <div class="position-relative">
                        <a href="{{ route('home') }}"
                           class="btn btn-secondary position-absolute top-0 start-0 m-3 z-index-1">
                            <i class="bi bi-arrow-bar-left"></i>
                            {{ __('Posts') }}
                        </a>
                        @if($post->image)
                            <img src="{{ Storage::url('post-images/'.$post->image) }}" class="card-img-top"
                                 alt="Post Image">
                        @else
                            <img src="https://loremflickr.com/320/190/all" class="card-img-top"
                                 alt="Post Image">
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="card-title mb-0 text-break">{{ $post->title }}</h3>
                            <small class="text-muted">{{ $date }} {{ __('at') }} {{ $time }}</small>
                        </div>
                        <p class="card-text">{!! $post->content !!}</p>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">
                                <i class="bi bi-eye-fill"></i>
                                {{ $post->views }}
                            </small>
                            <small class="text-muted">
                                {{ __('By') }} {{ $author }}
                            </small>
                        </div>
                    </div>
                </div>

                @auth
                    <hr style="height:1px;border:none;color:#333;background-color:#333;">
                    <h4>{{ __('Leave comment') }}</h4>

                    <x-comment-form :post="$post"/>

                    <hr style="height:1px;border:none;color:#333;background-color:#333;">
                @else
                    <div class="card bg-dark-subtle py-4">
                        <h5 class="text-center mb-4">{{ __('To leave a comment you must be authorized.') }}</h5>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('login') }}">
                                <button class="btn btn-primary me-3 px-4">{{ __('Login') }}</button>
                            </a>
                            <a href="{{ route('register') }}">
                                <button class="btn btn-outline-primary px-4">{{ __('Register') }}</button>
                            </a>
                        </div>
                    </div>
                @endauth
                @if($count = $comments->count())
                    <h4 class="mt-3 mb-4">{{ __('Comments') }} - {{ $count }}</h4>
                    <x-comment-card :comments="$comments" :post="$post"/>
                @else
                    <p class="text-center mt-5">{{ __('No comments yet.') }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection
