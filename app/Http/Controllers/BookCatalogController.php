<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookCatalogController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->latest()->paginate(9);
        return view('books.index', compact('books'));
    }

    public function search(Request $request)
    {
        $books = Book::with('category')
            ->where('title', 'like', "%{$request->query('q')}%")
            ->orWhere('author', 'like', "%{$request->query('q')}%")
            ->limit(9)
            ->get();

        return view('books._grid', compact('books'));
    }
}