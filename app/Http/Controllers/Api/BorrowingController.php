<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['member', 'book', 'user'])
            ->latest()
            ->paginate(15);
        return response()->json($borrowings);
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
            return response()->json([
                'message' => 'Buku tidak tersedia',
            ], 422);
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'borrowed';
        
        $borrowing = Borrowing::create($validated);
        $book->decrement('available');

        return response()->json([
            'message' => 'Peminjaman berhasil dicatat',
            'data' => $borrowing->load(['member', 'book', 'user']),
        ], 201);
    }

    public function show(Borrowing $borrowing)
    {
        return response()->json($borrowing->load(['member', 'book', 'user']));
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

        return response()->json([
            'message' => 'Peminjaman berhasil diupdate',
            'data' => $borrowing->load(['member', 'book', 'user']),
        ]);
    }

    public function destroy(Borrowing $borrowing)
    {
        if ($borrowing->status === 'borrowed') {
            $borrowing->book->increment('available');
        }
        
        $borrowing->delete();

        return response()->json([
            'message' => 'Peminjaman berhasil dihapus',
        ]);
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

        return response()->json([
            'message' => 'Buku berhasil dikembalikan',
            'data' => $borrowing->load(['member', 'book']),
        ]);
    }

    public function byMember(Member $member)
    {
        $borrowings = Borrowing::with(['book', 'user'])
            ->where('member_id', $member->id)
            ->latest()
            ->paginate(15);

        return response()->json($borrowings);
    }

    public function overdue()
    {
        $borrowings = Borrowing::with(['member', 'book'])
            ->where('status', 'borrowed')
            ->where('due_date', '<', now())
            ->get();

        return response()->json($borrowings);
    }

    public function statistics()
    {
        $stats = [
            'total_books' => Book::sum('stock'),
            'available_books' => Book::sum('available'),
            'total_members' => Member::where('status', 'active')->count(),
            'active_borrowings' => Borrowing::where('status', 'borrowed')->count(),
            'overdue_borrowings' => Borrowing::where('status', 'overdue')->count(),
            'returned_today' => Borrowing::whereDate('return_date', today())->count(),
        ];

        return response()->json($stats);
    }
}
