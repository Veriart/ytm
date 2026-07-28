<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $cartItems = [];
        $totalPrice = 0;
        
        $products = Product::whereIn('id', array_keys($cart))->get();
        foreach ($products as $product) {
            $quantity = $cart[$product->id];
            $subtotal = $product->price * $quantity;
            $totalPrice += $subtotal;
            $cartItems[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $subtotal
            ];
        }

        $user = Auth::user();

        return view('transaction.checkout', compact('cartItems', 'totalPrice', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'phone' => 'required|string',
            'courier' => 'required|string',
            'payment_method' => 'required|string',
            'shipping_cost' => 'required|integer',
            'discount' => 'required|integer',
            'service_fee' => 'required|integer',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Keranjang belanja Anda kosong.');
        }

        return DB::transaction(function () use ($request, $cart) {
            $user = Auth::user();
            
            // 1. Calculate and verify totals from DB products
            $products = Product::whereIn('id', array_keys($cart))->get();
            $subtotal = 0;
            $itemsData = [];

            foreach ($products as $product) {
                $qty = $cart[$product->id];
                
                // Validate stock
                if ($product->stock < $qty) {
                    throw new \Exception("Stok untuk produk '{$product->name}' tidak mencukupi.");
                }

                // Decrement stock
                $product->decrement('stock', $qty);
                $product->increment('sold_count', $qty);

                $itemSubtotal = $product->price * $qty;
                $subtotal += $itemSubtotal;

                $itemsData[] = [
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price' => $product->price
                ];
            }

            // Calculate final tagihan
            $totalPrice = $subtotal + $request->shipping_cost + $request->service_fee - $request->discount;

            // Update user profile address and phone if empty
            if (empty($user->address) || empty($user->phone)) {
                $user->update([
                    'address' => $request->shipping_address,
                    'phone' => $request->phone
                ]);
            }

            // 2. Generate Invoice Number
            $invoiceNumber = 'YTM-' . date('Ymd') . '-' . strtoupper(Str::random(6));

            // 3. Create Transaction
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'invoice_number' => $invoiceNumber,
                'total_price' => $totalPrice,
                'status' => 'paid', // Simulate auto-pay for direct checkout experience in this mockup
                'shipping_address' => $request->shipping_address,
                'shipping_cost' => $request->shipping_cost,
                'service_fee' => $request->service_fee,
                'discount' => $request->discount,
                'notes' => $request->payment_method . ' | ' . $request->courier
            ]);

            // 4. Create Transaction Details
            foreach ($itemsData as $item) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            // 5. Clear Cart Session
            session()->forget('cart');

            return redirect()->route('home')->with('success', "Pesanan Anda berhasil ditempatkan! No. Invoice: {$invoiceNumber}");
        });
    }
}
