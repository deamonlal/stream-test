<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';

    protected $fillable = [
        'full_name',
        'date_birth',
        'biography',
    ];

    protected $guarded = false;

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'author_books', 'author_id', 'book_id');
    }
}
