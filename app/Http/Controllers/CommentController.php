<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;


class CommentController extends Controller
{
    public function stored(Request $request, Post $post)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post->comments()->create($validated);

        return redirect()->route('post', $post);
    }

    public function delete(Comment $comment)
    {
        $post = $comment->post;

        $comment->delete();

        return redirect()->route('post', $post);
    }
}
