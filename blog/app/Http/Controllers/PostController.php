<?php

namespace App\Http\Controllers;

use App\Post;

class PostController extends Controller
{
    public function post()
    {
        return view('post', [
            'post' => \Auth::user()->post
        ]);
    }

    public function posts()
    {
        return view('posts', [
            'posts' => Post::paginate(5)
        ]);
    }
}
