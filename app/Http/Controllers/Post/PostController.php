<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'page'    => ['nullable', 'string'],
            'sort_by' => ['nullable', 'string'],
            'search'  => ['nullable', 'string'],
        ]);

        $page = $validated['page'] ?? null;
        $sort_by = $validated['sort_by'] ?? null;
        $search = $validated['search'] ?? null;
        $query = Post::query();

        //      Sort
        if ($sort_by == 'date_new') :
            $query->latest();
        elseif ($sort_by == 'date_old') :
            $query->oldest();
        elseif ($sort_by == 'views_popular') :
            $query->orderByDesc('views');
        elseif ($sort_by == 'views_unpopular') :
            $query->orderBy('views');
        else :
            $query->latest();
        endif;

        //      Search
        if ($search) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('content', 'like', "%$search%");
        }

        $posts = $query
            ->paginate(24)
            ->withQueryString();


        if ($search && $posts->isEmpty()) {
            return back()->withInput([
                'not-found' => 'Nothing was found in the search for: "' . $search . '"'
            ]);
        }

        if ($page && $posts->isEmpty()) {
            return redirect()->route('home');
        }

        return view('home', compact('posts'));
    }


    public function show(Post $post)
    {
        $author = $post->author();

        $comments = $post
            ->comments()
            ->latest()
            ->get();

        $date = $post->created_at->format('F j, Y');
        $time = $post->created_at->format('H:i');

        return view('posts.show', compact(['post', 'date', 'time', 'author', 'comments']));
    }
}
