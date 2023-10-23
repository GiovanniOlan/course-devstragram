<?php

namespace App\Http\Controllers\Auth;

use App\Models\Post;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }

    public function index(User $user)
    {
        $posts = $user->posts()->paginate(2);

        return view('posts.dashboard', compact('user', 'posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $request->user()->posts()->create($request->all());

        return redirect()->route('posts.index', ['user' => auth()->user()]);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', compact('user', 'post'));
    }
}
