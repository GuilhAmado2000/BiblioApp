<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasUuids;

    protected $fillable = [
        'id',
        'name',
        'edition',
        'description',
        'pages',
        'image'
    ];

    public function authorsToBook()
    {
        return $this->belongsToMany(
            Author::class,
            'book_author',
            'book_id',
            'author_id'
        );
    }

    public function publishersToBook()
    {
        return $this->belongsToMany(
            Publisher::class,
            'book_publisher',
            'book_id',
            'publisher_id'
        );
    }

    public function usersToBook()
    {
        return $this->belongsToMany(
            User::class,
            'book_user',
            'book_id',
            'user_id'
        );
    }

    public function type()
    {
        return $this->belongsTo(BookType::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
