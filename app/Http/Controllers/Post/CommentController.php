<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $validated = request()->validate([
            'comment' => ['required', 'string', 'max:1011']
        ]);

        Comment::query()->create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'comment' => $validated['comment'],
        ]);

        $request->session()->flash('status', 'Comment uploaded successfully !');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post, Comment $comment)
    {
        Gate::authorize('destroy', $comment);

        Comment::query()
            ->where('id', $comment->id)
            ->delete();

        return redirect()
            ->back()
            ->withInput([
                'status' => 'Comment deleted successfully !'
            ]);
    }
}
