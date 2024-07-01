<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use Couchbase\View;
use Egulias\EmailValidator\Warning\ObsoleteDTEXT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserPostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->where('author', Auth::user()->name)
            ->latest()
            ->paginate(15);

        return view('posts.user.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.user.create');
    }

    public function store(Request $request, StorePostRequest $postRequest)
    {
        $validated = $postRequest->validated();

        $image = $request->file('image') ?? null;

        if ($image) {
            $image_name = uniqid() . '_' . $image->getClientOriginalName();

            Storage::disk('public')->put('post-images/' . $image_name, file_get_contents($image));
        }

        Post::query()
            ->create([
                'author'  => Auth::user()->name,
                'title'   => $validated['title'],
                'content' => $validated['content'],
                'image'   => $image_name ?? null
            ]);

        $request->session()->flash('post', 'Post uploaded successfully !');

        return redirect()->route('user.posts.index');
    }

    public function show(string $id)
    {
        $post = Post::query()->findOrFail($id);

        $date = $post->created_at->format('F j, Y');
        $time = $post->created_at->format('H:i');

        return view('posts.user.show', compact(['post', 'date', 'time']));
    }

    public function edit(string $id)
    {
        $post = Post::query()->findOrFail($id);

        return view('posts.user.edit', compact('post'));
    }

    public function update(Request $request, string $id, StorePostRequest $postRequest)
    {
        $validated = $postRequest->validated();

        $post = Post::query()->findOrFail($id);

        $image = $request->file('image') ?? null;

        if ($image) {
            $image_name = uniqid() . '_' . $image->getClientOriginalName();
            $imgResult = $image_name;

            Storage::disk('public')->delete('post-images/' . $post->image);

            Storage::disk('public')->put('post-images/' . $image_name, file_get_contents($image));
        }

        Post::query()
            ->where('id', $id)
            ->update([
                'author'  => Auth::user()->name,
                'title'   => $validated['title'],
                'content' => $validated['content'],
                'image'   => $imgResult ?? $post->image,
            ]);

        $request->session()->flash('post', 'Post updated successfully !');

        return redirect()->route('user.posts.index');
    }

    public function destroy(string $id, Request $request)
    {
        Post::query()
            ->findOrFail($id)
            ->delete();

        $request->session()->flash('post', 'Post deleted successfully !');

        return redirect()->back();
    }
}
