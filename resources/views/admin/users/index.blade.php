@extends('layouts.admin')

@section('page.title', 'Users')

@section('content')

    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-9">
                        <h2>{{ __('Manage') }} <b>{{ __('Users') }}</b></h2>
                        <div class="badge badge-info bg-primary px-2 py-2"
                             style="font-size: 13px">
                            @isset($search)
                                {{ __('Found users:') }}
                            @else
                                {{ __('Total Users:') }}
                            @endisset
                            {{ $users->total() }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('admin.users.index') }}" method="GET" class="input-group mb-3">
                            <input type="search" class="form-control" placeholder="{{ __('Search Users...') }}"
                                   aria-label="Search" aria-describedby="search-button" name="search"
                                   title="{{ __("Search in users' names, and emails") }}"
                                   value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit" id="search-button"
                                    title="{{ __("Search in users' names, and emails") }}">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-success me-2">
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
            </div>

            <x-admin-alert/>

            @if(empty($users->total()) && empty($search))
                <div
                    class="card bg-warning-subtle text-center h4 my-3 py-3">{{ __('Nobody was found in database, probably nobody registered yet.') }}</div>
            @elseif(empty($users->total()) && isset($search))
                <div class="card bg-warning-subtle text-center h4 my-3 py-3">{{ __('No user was found by search: ') }}
                    "{{ $search }}"
                </div>
            @else
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
                            <tr class="clickable-row" style="cursor: crosshair">
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
                                        <a class="btn edit"
                                           style="color: #72720b; font-size: medium"
                                           href="{{ route('admin.users.edit', $user->id) }}">
                                            <i class="bi bi-gear-wide-connected"
                                            ></i>
                                        </a>
                                        <form action="{{ route('admin.users.delete_one_user', $user->id) }}"
                                              method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button title="Delete" class="btn delete"
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
            @endif
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