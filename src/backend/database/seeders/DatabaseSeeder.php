<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $author = [
            'name' => 'John Doe',
            'bibliography' => 'Bibliography',
        ];

        $book = [
            'name' => 'Book 1',
            'author' => $author,
            'isbn' => 'ISBN 1',
            'code' => '1234',
            'edition' => '2009',
            'publisher' => 'Bibliography',
            'language' => 'English',

        ];
    }
}
