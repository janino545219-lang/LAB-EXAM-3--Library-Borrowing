<?php

namespace App\Http\Controllers;

use App\Models\Penalty;
use Illuminate\Http\Request;

class PenaltyController extends Controller
{
    public function index()
    {
        $penalties = Penalty::with('borrowing.member', 'borrowing.book')->latest()->get();
        return view('penalties.index', compact('penalties'));
    }

    public function pay(Request $request, Penalty $penalty)
    {
        $penalty->update(['status' => 'Paid']);
        return redirect()->route('penalties.index')->with('success', 'Penalty marked as paid.');
    }
}
