@extends('layouts.admin')

@section('page.title', 'Comments')

@section('content')

    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-9">
                        <h2>{{ __('Manage') }} <b>{{ __('Comments') }}</b></h2>
                        <div class="badge badge-info bg-primary px-2 py-2" style="font-size: 13px">
                            @isset($search)
                                {{ __('Found comments:') }}
                            @else
                                {{ __('Total comments:') }}
                            @endisset
                            {{ $comments->total() }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <form action="{{ route('admin.comments.index') }}" method="GET" class="input-group mb-3">
                            <input type="search" class="form-control w-50 mb-3"
                                   placeholder="{{ __('Search Comments...') }}"
                                   aria-label="Search" aria-describedby="search-button" name="search"
                                   title="{{ __("Search in comments") }}"
                                   value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary mb-3" type="submit" id="search-button"
                                    title="{{ __("Search in posts' titles, and content") }}">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>

                        <div class="d-flex justify-content-end">
                            <button type="submit" form="deleteSelectedUsers" class="btn btn-danger">
                                <i class="bi bi-dash-circle"></i>
                                <span>{{ __('Delete') }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <x-admin-alert/>

            @if(empty($comments->total()) && empty($search))
                <div
                    class="card bg-warning-subtle text-center h4 my-3 py-3">{{ __('Nothing was found in database, probably there are no comments yet.') }}</div>
            @elseif(empty($comments->total()) && isset($search))
                <div class="card bg-warning-subtle text-center h4 my-3 py-3">{{ __('Nothing was found by search: ') }}
                    "{{ $search }}"
                </div>
            @else
                <form id="deleteSelectedUsers" method="POST" action="{{ route('admin.comments.delete_selected_comments') }}">
                    @method('DELETE')
                    @csrf
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Create Datetime') }}</th>
                            <th>{{ __('Comment author') }}</th>
                            <th>{{ __('Post title') }}</th>
                            <th>{{ __('Comment') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr class="clickable-row" style="cursor: crosshair">
                                <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox" name="selections[]" value="{{ $comment->id }}">
                                    <label for="checkbox" class="ps-2">{{ $loop->iteration }}</label>
                                </span>
                                </td>
                                <td>{{ $comment->created_at->format('d M, Y') }}
                                    at {{ $comment->created_at->format('H:i:s') }}</td>
                                <td>{{ $comment->author() }}</td>
                                <td>{{ $comment->post_title() }}</td>
                                <td>{{ format_str($comment->comment, 75) }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('posts.show', $comment->post_id()) }} #{{ $comment->id }}" class="btn" title="Show">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <form action="{{ route('admin.comments.delete_one_comment', $comment->id) }}"
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
            {{ $comments->links() }}
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
