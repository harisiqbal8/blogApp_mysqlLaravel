<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {

        return view ('posts.index', [
            'posts' => Post::latest()->filter(request(
                    ['search', 'category', 'author'])
                )->paginate(6)->withQueryString()
        ]);
    }

    public function show(Post $unq)
    {
        return view ('posts.show', [
            'postunique' => $unq
        ]);
    }

    public function create()
    {
        return view ('posts.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => 'required|image',
            'slug' => ['required', 'unique:posts,slug'],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', 'exists:categories,id']
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create($attributes);

        return redirect('/');
    }
}
