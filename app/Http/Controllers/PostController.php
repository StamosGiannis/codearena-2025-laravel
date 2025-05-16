<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index(?User $user = null)
    {
        $posts = Post::when($user, function ($query) use ($user) {
            return $query->where('user_id', $user->id);
        })->orderByDesc('promoted')
            ->whereNotNull('published_at')
            ->whereNotNull('image')
            ->orderByDesc('published_at')
            ->paginate(9);

        $authors = User::whereHas('posts', function ($query) {
            $query->whereNotNull('published_at');
        })->get();

        return view('posts.index', compact('posts', 'authors'));
    }

    public function show(Post $post)
    {
        if (is_null($post->published_at)) {
            abort(404);
        }

        // $post->load('author');
        $comments = $post->comments()->orderByDesc('created_at')->get();

        return view('posts.show', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    public function promoted()
    {
        $posts = Post::where('promoted', true)
            ->whereNotNull('published_at')
            ->whereNotNull('image')
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('posts.index', compact('posts'));
    }
}
