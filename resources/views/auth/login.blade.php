@extends('layouts.base')

@section('page.title', 'Login')

@section('content')
    <div class="container mt-4 w-25">
        <div class="card">
            <div class="card-header text-center">
                <h3 class="mt-1">{{ __('Login') }}</h3>
            </div>
            <div class="card-body">
                <x-error />
                <form method="POST" action="{{ route('login.authenticate') }}">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="email">{{ __('Email address') }}</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{ old('email') }}" required>
                    </div>
                    <x-single-error name="email"/>

                    <div class="form-group mt-3">
                        <label for="password">{{ __('Password') }}</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <x-single-error name="password"/>

                    <div class="form-group mt-3">
                        <input type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}> &nbsp;
                        <label for="remember">{{ __("Remember me") }}</label>
                    </div>

                    <div class="form-group d-flex align-items-center justify-content-between">
                        <button type="submit" class="btn btn-primary mt-3">{{ __('Login') }}</button>
                        <a href="{{ route('register') }}">{{ __("Doesn't have account yet? Register") }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
