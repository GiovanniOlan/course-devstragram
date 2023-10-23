<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(StoreCommentRequest $request, User $user, Post $post)
    {
        $post->comments()->create([
            ...$request->all(),
            'user_id' => $request->user()->id,
        ]);

        return back()->with('message', 'Comentario agregado correctamente.');
    }
}
