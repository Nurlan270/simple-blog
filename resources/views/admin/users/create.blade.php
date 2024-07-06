@extends('layouts.admin')

@section('page.title', 'Create user')

@section('content')

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="modal-header mb-3">
            <h4 class="modal-title">Create user</h4>
        </div>

        <x-admin-alert/>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <input type="text" class="form-control" placeholder="Name" required
                               name="name"
                               value="{{ old('name') }}">
                        <x-single-error name="name"/>
                    </div>
                    <div class="form-group mb-4">
                        <input type="email" class="form-control" placeholder="Email" required
                               name="email"
                               value="{{ old('email') }}">
                        <x-single-error name="email"/>
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" class="form-control" placeholder="Update password"
                               name="password"
                               value="{{ old('password') }}">
                        <x-single-error name="password"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>Permissions, roles</h4>
                    <div class="form-group">
                        <label for="role" class="d-block">Role</label>
                        <select class="form-select w-25" name="role">
                            <option value="none">Select...</option>
                            <option value="admin" {{ select_if(old('role')) }}>Admin</option>
                            <option value="user" selected {{ select_if(old('role')) }}>User</option>
                        </select>
                        <x-single-error name="role"/>
                    </div>
                    <div class="form-group">
                        <p class="mt-3">New features will be added soon</p>
                    </div>
                </div>
            </div>

            <div class="mt-3 d-flex justify-content-end">
                <a class="btn btn-outline-primary" href="{{ route('admin.users.index') }}">{{ __('Cancel') }}</a>
                <button type="submit" class="btn btn-primary ms-3 px-4">{{ __('Create') }}</button>
            </div>
        </div>
    </form>

@endsection
