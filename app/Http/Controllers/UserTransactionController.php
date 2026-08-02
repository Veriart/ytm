<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['details.product'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transaction.history', compact('transactions'));
    }

    public function confirmArrival(Request $request, $id)
    {
        $transaction = Transaction::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($transaction->status === 'shipped' || ($transaction->status === 'paid' && $transaction->delivery_option === 'pickup')) {
            $transaction->update([
                'status' => 'completed',
            ]);

            $message = $transaction->delivery_option === 'pickup' 
                ? 'Konfirmasi pengambilan barang berhasil. Terima kasih!' 
                : 'Konfirmasi penerimaan barang berhasil. Terima kasih!';

            return redirect()->route('transactions.history')->with('success', $message);
        }

        return redirect()->route('transactions.history')->with('error', 'Status transaksi tidak valid untuk konfirmasi.');
    }
}
