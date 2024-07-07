<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->validate([
            'search' => ['nullable', 'string']
        ]);

        $search = $query['search'] ?? null;
        $query = Comment::query();

        if (isset($search)) {
            $query->where('comment', 'like', "%$search%");
        }

        $comments = $query
                ->latest()
                ->paginate(25, ['id', 'created_at', 'post_id', 'user_id', 'comment'])
                ->withQueryString();

        return view('admin.comments.index', compact(['comments', 'search']));
    }

    public function delete_one_comment(Comment $comment)
    {
        Comment::query()->find($comment->id)->delete();

        return back()->withInput(['success' => 'Comment deleted']);
    }

    public function delete_selected_comments(Request $request)
    {
        $selections = $request->validate([
            'selections' => ['nullable', 'array']
        ]);

        if ($selections = array_values($selections)[0] ?? null) {
            Comment::query()->whereIn('id', $selections)->delete();

            return back()->withInput(['success' => 'Comments deleted']);
        } else {
            return back()->withInput(['error' => "You didn't selected any comments to delete"]);
        };
    }
}
