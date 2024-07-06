@extends('layouts.admin')

@section('page.title', 'Edit user')

@section('content')

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @method('PATCH')
        @csrf

        <div class="modal-header mb-3">
            <h4 class="modal-title">Edit <b>{{ $user->name }}'s</b> profile</h4>
        </div>

        <x-admin-alert/>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <input type="text" class="form-control" placeholder="Name" required
                               name="name"
                               value="{{ $user->name }}">
                        <x-single-error name="name"/>
                    </div>
                    <div class="form-group mb-4">
                        <input type="email" class="form-control" placeholder="Email" required
                               name="email"
                               value="{{ $user->email }}">
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
                            <option value="" {{ select_if(empty($user->role)) }}>Select...</option>
                            <option value="admin" {{ select_if($user->role == 'admin') }}>Admin</option>
                            <option value="user" {{ select_if($user->role == 'user') }}>User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <p class="mt-3">New features will be added soon</p>
                    </div>
                </div>
            </div>

            <div class="mt-3 d-flex justify-content-end">
                <a class="btn btn-outline-primary" href="{{ route('admin.users.index') }}">{{ __('Cancel') }}</a>
                <button type="submit" class="btn btn-primary ms-3 px-4">{{ __('Update') }}</button>
            </div>
        </div>
    </form>
@endsection
