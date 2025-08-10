<?php

namespace App\Http\Controllers;

use App\Models\BookType;
use Illuminate\Http\Request;

class TypeBookController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $allTypes = BookType::all();
        return response()->json($allTypes);
    }
}
