<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;

class PostController extends Controller
{
    public function store(StorePost $request)
    {
        $post = Post::create($request->data());

        $this->uploadRequestImage($request, $post);#

        $post = Post::with('user', 'images')->find($post->id);

        return [
            'status' => 'ok',
            'post' => $post
        ];
    }

    public function api(Request $request)
    {
        $posts = Post::with('user', 'images')->orderBy('created_at','desc')->take(10)->get();

    	return [
    		'status' => 'ok',
    		'posts' => $posts
		];
    }
}
