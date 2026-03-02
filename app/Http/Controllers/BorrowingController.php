<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['member', 'book', 'user'])
            ->latest()
            ->paginate(15);
        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $members = Member::where('status', 'active')->get();
        $books = Book::where('available', '>', 0)->get();
        return view('borrowings.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after:borrow_date',
            'notes' => 'nullable',
        ]);

        $book = Book::find($validated['book_id']);
        
        if ($book->available <= 0) {
            return back()->withErrors(['book_id' => 'Buku tidak tersedia'])->withInput();
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'borrowed';
        
        Borrowing::create($validated);
        
        $book->decrement('available');

        return redirect()->route('borrowings.index')->with('success', 'Peminjaman berhasil dicatat');
    }

    public function show(Borrowing $borrowing)
    {
        $borrowing->load(['member', 'book', 'user']);
        return view('borrowings.show', compact('borrowing'));
    }

    public function edit(Borrowing $borrowing)
    {
        $members = Member::where('status', 'active')->get();
        $books = Book::all();
        return view('borrowings.edit', compact('borrowing', 'members', 'books'));
    }

    public function update(Request $request, Borrowing $borrowing)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after:borrow_date',
            'notes' => 'nullable',
        ]);

        $borrowing->update($validated);

        return redirect()->route('borrowings.index')->with('success', 'Peminjaman berhasil diupdate');
    }

    public function destroy(Borrowing $borrowing)
    {
        if ($borrowing->status === 'borrowed') {
            $borrowing->book->increment('available');
        }
        
        $borrowing->delete();
        return redirect()->route('borrowings.index')->with('success', 'Peminjaman berhasil dihapus');
    }

    public function returnBook(Request $request, Borrowing $borrowing)
    {
        $validated = $request->validate([
            'return_date' => 'required|date',
            'fine' => 'nullable|numeric|min:0',
            'notes' => 'nullable',
        ]);

        $borrowing->update([
            'return_date' => $validated['return_date'],
            'status' => 'returned',
            'fine' => $validated['fine'] ?? 0,
            'notes' => $validated['notes'] ?? $borrowing->notes,
        ]);

        $borrowing->book->increment('available');

        return redirect()->route('borrowings.index')->with('success', 'Buku berhasil dikembalikan');
    }

    public function report()
    {
        $borrowings = Borrowing::with(['member', 'book'])
            ->whereBetween('borrow_date', [
                request('start_date', now()->startOfMonth()),
                request('end_date', now()->endOfMonth())
            ])
            ->get();

        return view('borrowings.report', compact('borrowings'));
    }

    public function overdue()
    {
        $borrowings = Borrowing::with(['member', 'book'])
            ->where('status', 'borrowed')
            ->where('due_date', '<', now())
            ->get();

        return view('borrowings.overdue', compact('borrowings'));
    }
}
