<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $allBooks = Book::all();
        return response()->json($allBooks);
    }

    public function getBookByUserId($userId): \Illuminate\Http\JsonResponse
    {
        $data = DB::table('book_user')
            ->join('books', 'books.id', '=', 'book_user.book_id')
            ->where('user_id', $userId)
            ->get();

        return response()->json($data);
    }
}
