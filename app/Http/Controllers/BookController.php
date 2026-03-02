<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->paginate(15);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
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
        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function show(Book $book)
    {
        $book->load('category', 'borrowings.member');
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
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

        return redirect()->route('books.index')->with('success', 'Buku berhasil diupdate');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus');
    }
}
