<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Services\OpenAIService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $this->content();
        return view ('posts.index', [

            'posts' => Post::latest()->filter(request(
                                        ['search', 'category', 'author', 'startDate', 'endDate'])
                                    )->paginate(6)->withQueryString(),
            
            'latestPost'=> Post::where('created_at', '>', Carbon::now()
                                ->setTimezone('GMT+5')
                                ->subHours(12))
                                ->count()
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

    public function content()
    {
        OpenAIService::generate('Generate me a sample short body for title: My favourite Hero');
    }
}
