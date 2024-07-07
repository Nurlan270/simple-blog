@extends('layouts.error')

@section('page.title', '403 - Access forbidden')

@pushonce('css')
    <link rel="stylesheet" href="{{ asset('css/403.css') }}">
@endpushonce

@section('content')

    <div id="app">
        <div>403</div>
        <div class="txt"> Forbidden<span class="blink">_</span></div>
        <a href="{{ route('home') }}" class="btn-home rounded-lg">Go Home</a>
    </div>

@endsection
