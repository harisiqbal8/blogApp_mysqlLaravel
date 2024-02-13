<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $with =['category', 'author'];

    public function scopeFilter($query, array $filters)
    {
        // Search Filter
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
            $query->where(fn ($query)=>
                $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%')
            )
        );

        // Date Filter
        $query->when(($filters['startDate'] ?? false && $filters['endDate']), function ($query) use ($filters) {
            $startDate = $filters['startDate'];
            $endDate = $filters['endDate'];
        
            return $query->where('created_at', '>=', $startDate)
                ->where('created_at', '<=', Carbon::parse($endDate)->endOfMinute());
        });

        // Category Filter
        $query->when($filters['category'] ?? false, fn ($query, $category) =>
            $query->whereHas('category', fn ($query) =>
                $query->where('slug', $category)
            )
        );

        // Author Filter
        $query->when($filters['author'] ?? false, fn ($query, $author) =>
            $query->whereHas('author', fn ($query) =>
                $query->where('username', $author)
            )
        );
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
