<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use function Symfony\Component\String\b;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->validate([
            'search'  => ['nullable', 'string'],
            'sort_by' => ['nullable', 'string']
        ]);

        $search = $query['search'] ?? null;
        $sort_by = $query['sort_by'] ?? null;

        $query = Post::query();

        if (isset($search)) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('content', 'like', "%$search%");

        }

        if (isset($sort_by)) {
            switch ($sort_by) {
                case 'date_new':
                    $query->latest(); break;
                case 'date_old':
                    $query->oldest(); break;
                case 'views_popular':
                    $query->orderByDesc('views'); break;
                case 'views_unpopular':
                    $query->orderBy('views'); break;
            }
        }

        $posts = $query
            ->latest()
            ->paginate(25, ['id', 'title', 'author_id', 'views', 'created_at'])
            ->withQueryString();

        return view('admin.posts.index', compact('posts', 'search'));
    }

    public function delete_one_post(Post $post, Request $request)
    {
        Post::query()
            ->find($post->id)
            ->delete();

        return back()->withInput(['success' => 'Post deleted']);
    }

    public function delete_selected_posts(Request $request)
    {
        $selections = $request->validate([
            'selections' => ['nullable', 'array']
        ]);

        if ($selections = array_values($selections)[0] ?? null) {
            Post::query()->whereIn('id', $selections)->delete();

            return back()->withInput(['success' => 'Posts deleted']);
        } else {
            return back()->withInput(['error' => "You didn't selected any posts to delete"]);
        };
    }
}
