<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'category_id',
    ];

    protected $with = ['category', 'author'];

    // Scopes

    public function scopeFilter($query, array $filters = [])
    {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query) =>
                $query
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%")
            )
        );

        $query->when($filters['category'] ?? false, fn($query, $category) =>
            $query->where(fn($query) =>
                $query->whereHas('category', fn($query) =>
                    $query->where('slug', $category)
                )
            )
        );

        $query->when($filters['author'] ?? false, fn($query, $author) =>
            $query->where(fn($query) =>
                $query->whereHas('author', fn($query) =>
                    $query->where('username', $author)
                )
            )
        );
    }


    // Relations

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
