<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::sum('stock');
        $availableBooks = Book::sum('available');
        $totalMembers = Member::where('status', 'active')->count();
        $activeBorrowings = Borrowing::where('status', 'borrowed')->count();
        $overdueBorrowings = Borrowing::where('status', 'overdue')->count();
        
        $recentBorrowings = Borrowing::with(['member', 'book', 'user'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'totalBooks',
            'availableBooks',
            'totalMembers',
            'activeBorrowings',
            'overdueBorrowings',
            'recentBorrowings'
        ));
    }
}
