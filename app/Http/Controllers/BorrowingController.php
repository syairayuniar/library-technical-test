<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function store(Request $request, Book $book)
    {
        DB::transaction(function () use ($book) {
            $book->refresh();
            $lockedBook = Book::lockForUpdate()->findOrFail($book->id);

            if ($lockedBook->stock < 1) {
                abort(422, 'Stok buku sedang habis.');
            }

            $lockedBook->decrement('stock');

            Borrowing::create([
                'user_id' => auth()->id(),
                'book_id' => $lockedBook->id,
                'borrowed_at' => now(),
                'status' => 'dipinjam',
            ]);
        });

        return back()->with('success', 'Buku berhasil dipinjam.');
    }

    public function update(Borrowing $borrowing)
    {
        if ($borrowing->user_id !== auth()->id()) {
            abort(403);
        }

        if ($borrowing->returned_at) {
            return back()->with('error', 'Buku ini sudah dikembalikan sebelumnya.');
        }

        DB::transaction(function () use ($borrowing) {
            $borrowing->update(['returned_at' => now(), 'status' => 'dikembalikan']);
            $borrowing->book()->increment('stock');
        });

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }

    public function index()
    {
        $borrowings = auth()->user()->borrowings()->with('book')->latest('borrowed_at')->paginate(10);
        return view('borrowings.index', compact('borrowings'));
    }

}