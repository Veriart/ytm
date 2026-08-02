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
            'status' => 'required|in:pending,paid,shipped,completed,cancelled',
            'tracking_number' => 'nullable|string|max:100',
        ]);

        $updateData = [
            'status' => $request->status,
        ];

        if ($request->has('tracking_number')) {
            $updateData['tracking_number'] = $request->tracking_number;
        }

        $transaction->update($updateData);

        return redirect()->route('admin.transaction.show', $transaction->id)->with('success', 'Status transaksi & nomor resi berhasil diperbarui!');
    }
}
