@php use App\Models\Post;use Illuminate\Support\Facades\Request; @endphp
@extends('layouts.base')

@section('page.title', 'Home')

@section('content')

    <x-alerts/>

    <div class="container mt-4">
        <h1>Recently added posts</h1>
        <!-- Sort and Search Form -->
        <form action="{{ route('home') }}" method="GET" class="mt-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <select name="sort_by" class="form-select" onchange="this.form.submit()">
                            <option value="">---&nbsp;&nbsp;&nbsp;&nbsp;Sort by&nbsp;&nbsp;&nbsp;&nbsp;---</option>
                            <option value="date_new" {{ auto_select('sort_by', 'date_new') }}>Date (Newest)</option>
                            <option value="date_old" {{ auto_select('sort_by', 'date_old') }}>Date (Oldest)</option>
                            <option value="views_popular" {{ auto_select('sort_by', 'views_popular') }}>Views
                                (Popular)
                            </option>
                            <option value="views_unpopular" {{ auto_select('sort_by', 'views_unpopular') }}>Views (Not
                                Popular)
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control" placeholder="Search posts..."
                               value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </div>
        </form>
        @if($posts->isEmpty())
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <p>There are no posts yet. <a href="{{ route('user.posts.create') }}">Add post</a> - be first! </p>
                </div>
            </div>
        @elseif($msg = Request::old('not-found'))
            <div class="card card-body bg-warning-subtle py-2 mt-4 text-center">
                {{ $msg }}
            </div>
        @else
            <div class="row mt-xxl-5">
                @foreach($posts as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @if($post->image)
                                <img src="{{ Storage::url('post-images/'.$post->image) }}" class="card-img-top"
                                     alt="Post Image">
                            @else
                                <img src="https://loremflickr.com/320/240/all?random={{ random_int(1,100) }}"
                                     class="card-img-top" alt="Post Image">
                            @endif
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0 w-50">{{ Str::limit($post->title, 30) }}</h5>
                                    <span class="text-muted">{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="card-text mt-2">{!! format_str($post->content, 350); !!}</p>
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{ $posts->links() }}
            </div>
        @endif
    </div>

@endsection
