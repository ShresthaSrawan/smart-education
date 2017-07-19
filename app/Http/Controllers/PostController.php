<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;

class PostController extends Controller
{
    public function store(StorePost $request)
    {
        Post::create($request->data());

        return redirect()->route('home')->withSuccess(trans('messages.create_success', [ 'entity' => 'Post' ]));
    }

    public function list(Request $request)
    {
    	return [
    		'status' => 'ok',
    		'posts' => Post::with('user', 'images')->take(10)->get()
		];
    }
}
