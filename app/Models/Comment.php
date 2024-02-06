<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function post() // FK:post_id
    {
        return $this->belongsTo(Post::class);
    }

    public function author() // FK:author_id
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
