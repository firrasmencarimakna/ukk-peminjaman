<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    // For Peminjam: View Catalog
    public function catalog()
    {
        $tools = Tool::where('stock', '>', 0)->get();
        return view('peminjam.tools.index', compact('tools'));
    }

    // For Peminjam: Store Loan Request
    public function store(Request $request)
    {
        $request->validate([
            'tool_id' => 'required|exists:tools,id',
            'borrow_date' => 'required|date|after_or_equal:today',
            'duration' => 'required|integer|min:1|max:14', // Max 2 weeks
        ]);

        $tool = Tool::find($request->tool_id);
        if ($tool->stock < 1) {
            return back()->with('error', 'Tool is out of stock.');
        }

        $borrowDate = \Carbon\Carbon::parse($request->borrow_date);
        $expectedReturnDate = $borrowDate->copy()->addDays((int)$request->duration);

        Loan::create([
            'user_id' => Auth::id(),
            'tool_id' => $request->tool_id,
            'borrow_date' => $borrowDate,
            'expected_return_date' => $expectedReturnDate,
            'status' => 'pending',
        ]);

        return redirect()->route('peminjam.loans.index')->with('success', 'Loan request submitted successfully.');
    }

    // For Peminjam: View My Loans
    public function myLoans()
    {
        $loans = Loan::where('user_id', Auth::id())->with('tool')->orderBy('created_at', 'desc')->get();
        return view('peminjam.loans.index', compact('loans'));
    }

    // For Admin: View All Loans (Same as petugas for now, but routed separately)
    public function adminIndex()
    {
        $loans = Loan::with(['user', 'tool'])->orderBy('created_at', 'desc')->get();
        return view('admin.loans.index', compact('loans'));
    }

    // For Petugas: View All Loans (Filterable)
    public function index()
    {
        $loans = Loan::with(['user', 'tool'])->orderBy('created_at', 'desc')->get();
        return view('petugas.loans.index', compact('loans'));
    }

    // For Petugas: Print Report
    public function report()
    {
        $loans = Loan::with(['user', 'tool'])->orderBy('created_at', 'desc')->get();
        return view('petugas.report', compact('loans'));
    }

    // For Petugas: Approve Loan
    public function approve(Loan $loan)
    {
        if ($loan->status !== 'pending') {
            return back()->with('error', 'Loan is not pending.');
        }

        if ($loan->tool->stock < 1) {
             return back()->with('error', 'Tool stock is insufficient.');
        }

        // Using Stored Procedure (as per requirement)
        // ensure strict mode is off or we handle multiple result sets if any (Laravel handles simple calls fine)
        DB::statement('CALL process_loan_approval(?, ?)', [$loan->id, Auth::id()]);
        
        return back()->with('success', 'Loan approved. Stock updated by system (Trigger & SP).');
    }

    // For Petugas: Reject Loan
    public function reject(Loan $loan)
    {
         if ($loan->status !== 'pending') {
            return back()->with('error', 'Loan is not pending.');
        }
        $loan->update(['status' => 'rejected']);
        return back()->with('success', 'Loan rejected.');
    }

    // For Petugas: Return Tool
    public function returnTool(Loan $loan)
    {
         if ($loan->status !== 'approved' && $loan->status !== 'returning') {
            return back()->with('error', 'Loan is not in a returnable state.');
        }
        
        $actualReturnDate = now();
        $expectedDate = \Carbon\Carbon::parse($loan->expected_return_date);
        
        // Calculate fine using DB function `calculate_fine` or PHP
        // Let's use PHP for UI feedback immediately, but relies on DB trigger for stock.
        
        $fine = 0;
        if ($actualReturnDate->gt($expectedDate)) {
            $daysLate = $actualReturnDate->diffInDays($expectedDate);
            $fine = $daysLate * 5000; // 5000 per day
        }

        $loan->update([
            'status' => 'returned',
            'actual_return_date' => $actualReturnDate,
            'fine' => $fine
        ]);

        return back()->with('success', "Tool returned. Fine: Rp " . number_format($fine));
    }

    // For Peminjam: Request Return
    public function requestReturn(Loan $loan)
    {
        if ($loan->user_id !== Auth::id()) {
            abort(403);
        }

        if ($loan->status !== 'approved') {
            return back()->with('error', 'Only approved loans can be returned.');
        }

        $loan->update(['status' => 'returning']);

        return back()->with('success', 'Return request submitted. Please hand over the tool to the officer.');
    }
}
