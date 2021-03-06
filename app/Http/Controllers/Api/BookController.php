<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BookController extends Controller
{
    public function index()
    {
        return Book::all();
    }

    public function store(Request $request)
    {
        if (strlen($request->isbn) > 14) {
            return Response::json(['message' => 'Invalid ISBN'], 400);
        }

        $book = Book::create($request->all());
        return response()->json($book, 201);
    }

    public function categories()
    {
        $books = Book::all();
        $allCategories = collect();

        foreach($books as $book) {
            if(str_contains($book->category, ',')) {
                $splitArray = array_map('trim', explode(',', $book->category));
                for ($i = 0; $i < count($splitArray); $i++) {
                    $allCategories->push($splitArray[$i]);
                }
            } else {
                $allCategories->push($book->category);
            }
        }

        return response()->json($allCategories->unique());
    }

    public function filter(Request $request)
    {
        if ($request->has('author') && $request->has('category')){
            $books = Book::where('author', $request->author)
                ->where('category', 'LIKE', '%'.$request->category.'%')->get();
            return response()->json($books);
        } elseif($request->has('author')) {
            return response()->json(Book::where('author', $request->author)->get());
        } elseif ($request->has('category')) {
            return response()->json(Book::where('category', 'LIKE', '%'.$request->category.'%')->get());
        }
    }
}
