<?php

namespace App\Http\Controllers;

use App\Models\CustomTag;
use App\Models\Grade;
use App\Models\Post;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function store(StorePost $request)
    {
        $post = DB::transaction(function () use ($request) {
            $post = Post::create($request->data());
            $this->uploadRequestImage($request, $post);
            $post->tags()->createMany($request->tags());
            $post = Post::with('user', 'images', 'tags.tagable')->find($post->id);

            return $post;
        });

        return [
            'status'  => 'ok',
            'post'    => $post,
            'message' => trans('messages.create.success', [ 'entity' => 'Post' ])
        ];
    }

    public function tags(Request $request)
    {
        $query = $request->get('query');

        $users = User::where('first_name', 'like', "%{$query}%")->orWhere('last_name', 'like', "%{$query}%")->orWhere('email', 'like', "%{$query}%")->get()->map(function ($user) {
            return [
                'code' => 'user-' . $user->id,
                'name' => $user->name,
                'type' => User::class,
                'id'   => $user->id
            ];
        });

        $grades = Grade::where('name', 'like', "%{$query}%")->get()->map(function ($grade) {
            return [
                'code' => 'grade-' . $grade->id,
                'name' => $grade->name,
                'type' => Grade::class,
                'id'   => $grade->id
            ];
        });

        $subjects = Subject::where('name', 'like', "%{$query}%")->get()->map(function ($subject) {
            return [
                'code' => 'subject-' . $subject->id,
                'name' => $subject->name,
                'type' => Subject::class,
                'id'   => $subject->id
            ];
        });

        $custom = CustomTag::where('name', 'like', "%{$query}%")->get()->map(function ($custom) {
            return [
                'code' => 'custom-' . $custom->id,
                'name' => $custom->name,
                'type' => CustomTag::class,
                'id'   => $custom->id
            ];
        });

        return array_merge($users->all(), $grades->all(), $subjects->all(), $custom->all());
    }

    public function api()
    {
        $posts = Post::relatedTo(auth()->user())->with('user', 'images', 'tags.tagable')->orderBy('created_at', 'desc')->paginate(10);
        return [
            'status' => 'ok',
            'posts'  => $posts
        ];
    }
}
