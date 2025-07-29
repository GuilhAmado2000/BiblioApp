<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookType extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
