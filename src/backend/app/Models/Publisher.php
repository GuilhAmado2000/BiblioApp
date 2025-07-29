<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'description',
        'address',
        'phone_number',
        'email',
        'website',
        'image_logo'
    ];

    public function booksToPublisher()
    {
        return $this->belongsToMany(
            Book::class,
            'book_publisher',
            'publisher_id',
            'book_id'
        );
    }
}
