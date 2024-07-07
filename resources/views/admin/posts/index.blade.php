@extends('layouts.admin')

@section('page.title', 'Posts')

@section('content')

    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-9">
                        <h2>{{ __('Manage') }} <b>{{ __('Posts') }}</b></h2>
                        <div class="badge badge-info bg-primary px-2 py-2" style="font-size: 13px">
                            @isset($search)
                                {{ __('Found posts:') }}
                            @else
                                {{ __('Total posts:') }}
                            @endisset
                            {{ $posts->total() }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <form action="#" method="GET" class="input-group mb-3">
                            <input type="search" class="form-control w-50 mb-3" placeholder="{{ __('Search Posts...') }}"
                                   aria-label="Search" aria-describedby="search-button" name="search"
                                   title="{{ __("Search in posts' titles, and content") }}"
                                   value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary mb-3" type="submit" id="search-button"
                                    title="{{ __("Search in posts' titles, and content") }}">
                                <i class="bi bi-search"></i>
                            </button>
                            <select class="form-select w-auto ms-2" name="sort_by" aria-label="{{ __('Sort by') }}" onchange="this.form.submit()">
                                <option value="">{{ __('Sort by...') }}</option>
                                <option
                                    value="date_new" {{ request('sort_by') == 'date_new' ? 'selected' : '' }}>{{ __('Date (Newest)') }}</option>
                                <option
                                    value="date_old" {{ request('sort_by') == 'date_old' ? 'selected' : '' }}>{{ __('Date (Oldest)') }}</option>
                                <option
                                    value="views_popular" {{ request('sort_by') == 'views_popular' ? 'selected' : '' }}>{{ __('Views (Popular)') }}</option>
                                <option
                                    value="views_unpopular" {{ request('sort_by') == 'views_unpopular' ? 'selected' : '' }}>{{ __('Views (Unpopular)') }}</option>
                            </select>
                            <button class="btn btn-outline-secondary" type="submit" id="sort-button"
                                    title="{{ __('Sort posts') }}">
                                <i class="bi bi-sort-alpha-down"></i>
                            </button>
                        </form>


                        <div class="d-flex justify-content-end">
                            <a href="{{ route('user.posts.create') }}" class="btn btn-success me-2">
                                <i class="bi bi-plus-circle"></i>
                                <span>{{ __('Create post') }}</span>
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

            @if(empty($posts->total()) && empty($search))
                <div
                    class="card bg-warning-subtle text-center h4 my-3 py-3">{{ __('Nothing was found in database, probably there are no posts yet.') }}</div>
            @elseif(empty($posts->total()) && isset($search))
                <div class="card bg-warning-subtle text-center h4 my-3 py-3">{{ __('Nothing was found by search: ') }}
                    "{{ $search }}"
                </div>
            @else
                <form id="deleteSelectedUsers" method="POST" action="#">
                    @method('DELETE')
                    @csrf
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Create Datetime') }}</th>
                            <th>{{ __('Views') }}</th>
                            <th>{{ __('Author') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr class="clickable-row" style="cursor: crosshair">
                                <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox" name="selections[]" value="{{ $post->id }}">
                                    <label for="checkbox" class="ps-2">{{ $loop->iteration }}</label>
                                </span>
                                </td>
                                <td>{{ $post->created_at->format('d M, Y') }}
                                    at {{ $post->created_at->format('H:i:s') }}</td>
                                <td>{{ $post->views }}</td>
                                <td>{{ $post->author() }}</td>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('posts.show', $post->id) }}" class="btn" title="Show">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <form action="{{ route('admin.posts.delete_one_post', $post->id) }}"
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
            {{ $posts->links() }}
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
