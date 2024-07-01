<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->latest()
            ->paginate(24);

        if ($posts->isEmpty() && isset($_GET['page'])){
            return Redirect::to(url()->previous());
        }

        return view('home', compact('posts'));
    }


    public function show(Post $post)
    {
        $date = $post->created_at->format('F j, Y');
        $time = $post->created_at->format('H:i');

        return view('posts.show', compact(['post', 'date', 'time']));
    }

}
