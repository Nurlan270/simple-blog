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
use function Sodium\increment;

class UserPostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->where('author_id', Auth::user()->id)
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
                'author_id'  => Auth::user()->id,
                'title'   => $validated['title'],
                'content' => $validated['content'],
                'image'   => $image_name ?? null
            ]);

        $request->session()->flash('post', 'Post uploaded successfully !');

        return redirect()->route('user.posts.index');
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
                'author_id'  => Auth::user()->id,
                'title'   => $validated['title'],
                'content' => $validated['content'],
                'image'   => $imgResult ?? $post->image,
            ]);

        $request->session()->flash('post', 'Post updated successfully !');

        return redirect()->route('user.posts.index');
    }

    public function destroy(string $id, Request $request)
    {
        $post = Post::query()->findOrFail($id);

        Storage::disk('public')->delete('post-images/'.$post->image);
        $post->delete();

        $request->session()->flash('post', 'Post deleted successfully !');

        return redirect()->back();
    }
}
