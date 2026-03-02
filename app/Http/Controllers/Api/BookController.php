<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->paginate(15);
        return response()->json($books);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'isbn' => 'nullable|unique:books,isbn',
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'publisher' => 'nullable|max:255',
            'publish_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'category_id' => 'nullable|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable',
        ]);

        $validated['available'] = $validated['stock'];
        $book = Book::create($validated);

        return response()->json([
            'message' => 'Buku berhasil ditambahkan',
            'data' => $book->load('category'),
        ], 201);
    }

    public function show(Book $book)
    {
        return response()->json($book->load('category', 'borrowings.member'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'isbn' => 'nullable|unique:books,isbn,' . $book->id,
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'publisher' => 'nullable|max:255',
            'publish_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'category_id' => 'nullable|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable',
        ]);

        $book->update($validated);

        return response()->json([
            'message' => 'Buku berhasil diupdate',
            'data' => $book->load('category'),
        ]);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            'message' => 'Buku berhasil dihapus',
        ]);
    }

    public function search($keyword)
    {
        $books = Book::with('category')
            ->where('title', 'like', "%{$keyword}%")
            ->orWhere('author', 'like', "%{$keyword}%")
            ->orWhere('isbn', 'like', "%{$keyword}%")
            ->paginate(15);

        return response()->json($books);
    }
}
