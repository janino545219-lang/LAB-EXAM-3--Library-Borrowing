<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\PenaltyController;
use App\Models\Book;
use App\Models\Member;
use App\Models\Borrowing;
use App\Models\Penalty;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/dashboard', function () {
    $totalBooks = Book::sum('copies_available');
    $totalMembers = Member::count();
    $activeBorrowings = Borrowing::where('status', 'Borrowed')->count();
    $unpaidPenalties = Penalty::where('status', 'Unpaid')->count();
    $recentBorrowings = Borrowing::with(['member', 'book'])->latest()->take(5)->get();
    return view('dashboard', compact('totalBooks', 'totalMembers', 'activeBorrowings', 'unpaidPenalties', 'recentBorrowings'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('books', BookController::class);
    Route::resource('members', MemberController::class);
    Route::resource('borrowings', BorrowingController::class);
    Route::post('borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');
    Route::resource('penalties', PenaltyController::class)->only(['index', 'update']);
    Route::post('penalties/{penalty}/pay', [PenaltyController::class, 'pay'])->name('penalties.pay');
});

require __DIR__.'/auth.php';
