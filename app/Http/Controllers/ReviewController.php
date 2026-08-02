<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $product = Product::findOrFail($id);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Recalculate average rating
        $averageRating = Review::where('product_id', $product->id)->avg('rating');
        $product->update([
            'rating' => $averageRating
        ]);

        return back()->with('success', 'Ulasan Anda berhasil ditambahkan!');
    }

    public function storeFromTransaction(Request $request, $transactionId, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $transaction = Transaction::where('id', $transactionId)
            ->where('user_id', Auth::id())
            ->where('status', 'completed')
            ->firstOrFail();

        $exists = $transaction->details()->where('product_id', $productId)->exists();
        if (!$exists) {
            abort(404, 'Produk tidak ditemukan dalam transaksi ini.');
        }

        $alreadyReviewed = Review::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->where('transaction_id', $transactionId)
            ->exists();

        if ($alreadyReviewed) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk produk ini pada transaksi ini.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'transaction_id' => $transactionId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $product = Product::findOrFail($productId);
        $averageRating = Review::where('product_id', $productId)->avg('rating');
        $product->update([
            'rating' => $averageRating
        ]);

        return back()->with('success', 'Ulasan Anda untuk produk ' . $product->name . ' berhasil ditambahkan!');
    }
}
