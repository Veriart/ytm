<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->latest()->get();
        return view('admin.transaction.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaction::with(['user', 'details.product'])->findOrFail($id);
        return view('admin.transaction.show', compact('transaction'));
    }

    public function updateStatus(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,paid,shipped,cancelled',
        ]);

        $transaction->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.transaction.show', $transaction->id)->with('success', 'Status transaksi berhasil diperbarui!');
    }
}
