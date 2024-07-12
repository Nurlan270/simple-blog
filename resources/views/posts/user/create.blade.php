@extends('layouts.base')

@section('page.title', __('Create Post'))

@pushonce('css')
    <style>
        .trix-button--icon-heading-1,
        .trix-button--icon-attach,
        .trix-button-group--file-tools,
        .trix-button-group-spacer,
        .trix-button--icon-decrease-nesting-level,
        .trix-button--icon-increase-nesting-level
        {display: none;}
    </style>
@endpushonce

@pushonce('trix')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endpushonce

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header text-center">{{ __('Create Post') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.posts.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title">{{ __('Title') }}</label>
                                <input type="text" class="form-control" name="title" id="title"
                                       value="{{ old('title') }}" required>
                                <x-single-error name="title"/>
                            </div>

                            <div class="form-group">
                                <label for="content">{{ __('Content') }}</label>
                                <input id="x" type="hidden" name="content"
                                       value="{{ old('content') }}">
                                <trix-editor input="x" id="content"></trix-editor>
                                <x-single-error name="content"/>
                            </div>

                            <div class="form-group">
                                <label for="formFile" class="form-label" title="Not required">{{ __('Upload preview image') }}</label>
                                <input type="file" class="form-control" id="formFile" name="image"
                                       accept="image/*" onchange="previewImage(event)">
                                <img id="imagePreview" src="#" alt="Image Preview" class="mt-2 img-fluid"
                                     style="display: none; max-height: 300px;">
                                <x-single-error name="image" />
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">{{ __('Create Post') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
