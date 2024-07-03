@extends('layouts.base')

@section('page.title', 'Register')

@section('content')
    <div class="container mt-4 col-md-6 col-lg-4">
        <div class="card">
            <div class="card-header text-center">
                <h3 class="mt-1">{{ __('Register') }}</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register.store') }}">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="{{ old('name') }}" required>
                    </div>
                    <x-single-error name="name" />

                    <div class="form-group mt-3">
                        <label for="email">{{ __('Email address') }}</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{ old('email') }}" required>
                    </div>
                    <x-single-error name="email" />

                    <div class="form-group mt-3">
                        <label for="password">{{ __('Password') }}</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <x-single-error name="password" />

                    <div class="form-group mt-3">
                        <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                        <input type="password" class="form-control" id="password_confirmation"
                               name="password_confirmation"
                               required>
                    </div>

                    <div class="form-group mt-3">
                        <input type="checkbox" name="terms" id="terms"
                        {{ old('terms') ? 'checked' : '' }}> &nbsp;
                        <label for="terms">{{ __("I'm accepting Terms of Service") }}</label>
                    </div>
                    <x-single-error name="terms" />

                    <div class="form-group d-flex align-items-center justify-content-between">
                        <button type="submit" class="btn btn-primary mt-3 px-4">{{ __('Register') }}</button>
                        <a href="{{ route('login') }}" class="small ms-3">{{ __('Already has an account? Log in') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
