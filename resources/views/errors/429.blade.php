@extends('layouts.base')

@section('page.title', '429 Too many requests')

@section('content')
    <div class="container mt-4">
        <div class="text-center">
            <h1 class="display-1 text-warning">429</h1>
            <h2 class="mb-4">Too Many Requests</h2>
            <p class="lead">You've sent too many requests in a given amount of time. Please try again later.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
        </div>
    </div>
@endsection
