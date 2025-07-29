<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'biography',
        'perfil'
    ];

    public function booksToAuthor()
    {
        return $this->belongsToMany(
            Book::class,
            'book_author',
            'author_id',
            'book_id'
        );
    }
}
