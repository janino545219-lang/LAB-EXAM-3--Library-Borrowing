<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Member;
use App\Models\Penalty;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['member', 'book', 'penalty'])->latest()->get();
        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $members = Member::all();
        $books = Book::where('copies_available', '>', 0)->get();
        return view('borrowings.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrow_date',
        ]);

        $book = Book::findOrFail($validated['book_id']);
        if ($book->copies_available <= 0) {
            return back()->withErrors(['book_id' => 'Book not available']);
        }

        $validated['status'] = 'Borrowed';
        Borrowing::create($validated);

        $book->decrement('copies_available');

        return redirect()->route('borrowings.index')->with('success', 'Borrowing recorded successfully.');
    }

    public function returnBook(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'return_date' => 'required|date|after_or_equal:borrow_date',
        ]);

        $borrowing->update([
            'return_date' => $request->return_date,
            'status' => 'Returned',
        ]);

        $borrowing->book->increment('copies_available');

        // Check if overdue
        $dueDate = \Carbon\Carbon::parse($borrowing->due_date);
        $returnDate = \Carbon\Carbon::parse($request->return_date);

        if ($returnDate->gt($dueDate)) {
            $daysOverdue = $returnDate->diffInDays($dueDate);
            $penaltyAmount = $daysOverdue * 10; // e.g. 10 units per day

            $borrowing->update(['status' => 'Overdue']); // Can also keep as returned but with penalty, prompt says (Borrowed/Returned/Overdue).

            Penalty::create([
                'borrowing_id' => $borrowing->id,
                'amount' => $penaltyAmount,
                'status' => 'Unpaid'
            ]);
        }

        return redirect()->route('borrowings.index')->with('success', 'Book returned successfully.');
    }

    public function destroy(Borrowing $borrowing)
    {
        if ($borrowing->status === 'Borrowed') {
            $borrowing->book->increment('copies_available');
        }
        $borrowing->delete();
        return redirect()->route('borrowings.index')->with('success', 'Record deleted.');
    }
}
