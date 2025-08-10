<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $allPublisher = Publisher::all();
        return response()->json($allPublisher);
    }
}
