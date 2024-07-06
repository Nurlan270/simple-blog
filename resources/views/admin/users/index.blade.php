@extends('layouts.admin')

@section('page.title', 'Users')

@section('content')

    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-9">
                        <h2>{{ __('Manage') }} <b>{{ __('Users') }}</b></h2>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i>
                            <span>{{ __('New User') }}</span>
                        </a>
                        <button type="submit" form="deleteSelectedUsers" class="btn btn-danger">
                            <i class="bi bi-dash-circle"></i>
                            <span>{{ __('Delete') }}</span>
                        </button>
                    </div>
                </div>
            </div>

            <x-admin-alert/>

            <form id="deleteSelectedUsers" method="POST" action="{{ route('admin.users.delete_selected_users') }}">
                @method('DELETE')
                @csrf
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Role') }}</th>
                        <th>{{ __('Create Datetime') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr class="clickable-row">
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox" name="selections[]" value="{{ $user->id }}">
                                    <label for="checkbox" class="ps-2">{{ $loop->iteration }}</label>
                                </span>
                            </td>
                            <td>{{ strtoupper($user->role) }}</td>
                            <td>{{ $user->created_at->format('d M, Y') }}
                                at {{ $user->created_at->format('H:i:s') }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.users.edit', $user->id) }}">
                                        <button type="button" title="Edit"
                                                class="edit me-1 text-decoration-none border-0">
                                            <i class="bi bi-gear-wide-connected" style="color: #72720b; font-size: medium"></i>
                                        </button>
                                    </a>
                                    <form action="{{ route('admin.users.delete_one_user', $user->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button title="Delete" class="delete text-decoration-none border-0"
                                                type="submit">
                                            <i class="bi bi-trash-fill" style="color: red; font-size: medium"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </form>
            <!-- Pagination -->
            {{ $users->links() }}
        </div>
    </div>
@endsection

@pushonce('script')

    <script>
        $(document).ready(function () {
            $('tr.clickable-row').click(function (event) {
                var $target = $(event.target);
                if (!$target.is('input:checkbox') && !$target.is('button') && !$target.is('a')) {
                    var $checkbox = $(this).find('input:checkbox');
                    $checkbox.prop('checked', !$checkbox.prop('checked'));
                }
            });

            $('button, a').click(function (event) {
                event.stopPropagation();
            });
        });
    </script>

@endpushonce
