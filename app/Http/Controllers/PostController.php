<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index()
    {
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
}
