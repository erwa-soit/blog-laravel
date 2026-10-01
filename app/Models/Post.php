<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use function PHPUnit\Framework\returnArgument;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'author', 'body'];
// ini yang boleh di isi sisanya diluar itu tidak boleh diisi

    protected $with = ['author', 'category'];

public function author(): BelongsTo {
    return $this->belongsTo(User::class);
}

public function category(): BelongsTo {
    return $this->belongsTo(Category::class);
}
    public function scopeFilter(Builder $query, array $filters) : void
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function($query, $category) {
            return $query->whereHas('category', fn (Builder $query) =>
                $query->where('slug', $category)
            );
    });

        $query->when($filters['author'] ?? false, function($query, $author) {
            return $query->whereHas('author', fn (Builder $query) =>
                $query->where('username', $author)
            );
    });

    }
}
