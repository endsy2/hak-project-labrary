<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
class BookController extends Controller
{
    public function index()
    {
        return response()->json(Book::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|unique:books,book_id',
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer',
            'price' => 'required|numeric',
            'status' => 'required|in:available,unavailable',
        ]);

        $book = Book::create($validated);
        return response()->json($book);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer',
            'price' => 'required|numeric',
            'status' => 'required|in:available,unavailable',
        ]);

        $book->update($validated);
        return response()->json($book);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }
}
