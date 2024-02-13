<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $latestPost = Post::where('created_at', '>', Carbon::now()->setTimezone('GMT+5')->subHours(12))->count();
        // dd(Carbon::now()->setTimezone('GMT+5')->subHours(12));
        return view ('posts.index', [
            'posts' => Post::latest()->filter(request(
                    ['search', 'category', 'author', 'startDate', 'endDate'])
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
