<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $allAuthor = Author::all();
        return response()->json($allAuthor);
    }
}
