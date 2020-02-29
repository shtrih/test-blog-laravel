<?php

namespace App\Http\Controllers;

use App\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function post()
    {
        return view('post', [
            'post' => \Auth::user()->post
        ]);
    }

    public function posts()
    {
        if (!\Gate::allows('view-posts')) {
            abort(404);
        }

        return view('posts', [
            'posts' => Post::paginate(5)
        ]);
    }
}
