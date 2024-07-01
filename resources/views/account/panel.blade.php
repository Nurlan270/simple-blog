@extends('layouts.base')

@section('page.title', 'Account panel')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

               <x-alerts />

                <!-- Change Name Section -->
                <div class="card mb-4">
                    <div class="card-header">{{ __('Change Name') }}</div>
                    <div class="card-body">
                        <form action="{{ route('account.updateName') }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label for="name">{{ __('New Name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $name }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Update Name') }}</button>
                        </form>
                    </div>
                </div>

                <!-- Change Password Section -->
                <div class="card mb-4">
                    <div class="card-header">{{ __('Change Password') }}</div>
                    <div class="card-body">
                        <form action="{{ route('account.updatePassword') }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label for="current_password">{{ __('Current Password') }}</label>
                                <input type="password" class="form-control" id="current_password"
                                       name="current_password" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">{{ __('New Password') }}</label>
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="new_password_confirmation">{{ __('Confirm New Password') }}</label>
                                <input type="password" class="form-control" id="new_password_confirmation"
                                       name="new_password_confirmation" required>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Update Password') }}</button>
                        </form>
                    </div>
                </div>

                <!-- Danger Zone Section -->
                <div class="card mb-4">
                    <div class="card-header text-danger">{{ __('Danger Zone') }}</div>
                    <div class="card-body">
                        <form action="{{ route('account.deleteAccount') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
