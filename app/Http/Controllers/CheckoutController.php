<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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
        $shippingMethods = ShippingMethod::where('is_active', true)->get();

        return view('transaction.checkout', compact('cartItems', 'totalPrice', 'user', 'shippingMethods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'delivery_option' => 'required|string|in:shipping,pickup',
            'payment_mode' => 'required|string|in:transfer,cash',
            'phone' => 'required|string',
            'shipping_address' => 'required_if:delivery_option,shipping|nullable|string',
            'courier' => 'required_if:delivery_option,shipping|nullable|string',
            'shipping_cost' => 'required|integer',
            'discount' => 'required|integer',
            'service_fee' => 'required|integer',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Keranjang belanja Anda kosong.');
        }

        // Force transfer mode if delivery is shipping
        $paymentMode = $request->delivery_option === 'shipping' ? 'transfer' : $request->payment_mode;

        try {
            $result = DB::transaction(function () use ($request, $cart, $paymentMode) {
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
                        'id' => $product->id,
                        'product_id' => $product->id,
                        'quantity' => $qty,
                        'price' => $product->price,
                        'name' => substr($product->name, 0, 50),
                    ];
                }

                // Determine shipping parameters based on delivery option
                $isPickup = $request->delivery_option === 'pickup';
                $shippingCost = $isPickup ? 0 : $request->shipping_cost;
                $shippingAddress = $isPickup ? 'Ambil di Toko Utama (YTM)' : $request->shipping_address;
                $courierNotes = $isPickup ? 'Ambil di Toko' : $request->courier;

                // Calculate final tagihan
                $totalPrice = $subtotal + $shippingCost + $request->service_fee - $request->discount;

                // Update user profile address and phone if empty
                if (empty($user->address) || empty($user->phone)) {
                    $user->update([
                        'address' => $shippingAddress,
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
                    'status' => 'pending', // Set initial status to pending
                    'delivery_option' => $request->delivery_option,
                    'shipping_address' => $shippingAddress,
                    'shipping_cost' => $shippingCost,
                    'service_fee' => $request->service_fee,
                    'discount' => $request->discount,
                    'notes' => ($paymentMode === 'cash' ? 'Cash' : 'Midtrans') . ' | ' . $courierNotes
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

                // 5. Conditional Payment Gateway Integration
                if ($paymentMode === 'cash') {
                    // Clear Cart Session
                    session()->forget('cart');

                    return [
                        'type' => 'cash',
                        'transaction' => $transaction
                    ];
                }

                // 5. Midtrans API Integration
                $midtransServerKey = env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-YOUR_SERVER_KEY');
                $isProduction = env('MIDTRANS_IS_PRODUCTION', false);
                $midtransUrl = $isProduction 
                    ? 'https://app.midtrans.com/snap/v1/transactions' 
                    : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

                $authHeader = 'Basic ' . base64_encode($midtransServerKey . ':');

                // Prepare item details for Midtrans
                $midtransItems = [];
                foreach ($itemsData as $item) {
                    $midtransItems[] = [
                        'id' => 'item_' . $item['id'],
                        'price' => (int)$item['price'],
                        'quantity' => (int)$item['quantity'],
                        'name' => $item['name']
                    ];
                }

                // Add shipping cost item if shipping
                if (!$isPickup && $shippingCost > 0) {
                    $midtransItems[] = [
                        'id' => 'shipping_fee',
                        'price' => (int)$shippingCost,
                        'quantity' => 1,
                        'name' => 'Ongkos Kirim (' . $courierNotes . ')'
                    ];
                }

                // Add service fee
                if ($request->service_fee > 0) {
                    $midtransItems[] = [
                        'id' => 'service_fee',
                        'price' => (int)$request->service_fee,
                        'quantity' => 1,
                        'name' => 'Biaya Jasa Layanan'
                    ];
                }

                // Add discount as a negative item
                if ($request->discount > 0) {
                    $midtransItems[] = [
                        'id' => 'discount_promo',
                        'price' => -(int)$request->discount,
                        'quantity' => 1,
                        'name' => 'Diskon Promo'
                    ];
                }

                // Prepare Midtrans Payload
                $payload = [
                    'transaction_details' => [
                        'order_id' => $invoiceNumber,
                        'gross_amount' => (int)$totalPrice,
                    ],
                    'item_details' => $midtransItems,
                    'customer_details' => [
                        'first_name' => $user->name,
                        'email' => $user->email,
                        'phone' => $request->phone,
                        'shipping_address' => [
                            'first_name' => $user->name,
                            'phone' => $request->phone,
                            'address' => $shippingAddress,
                        ]
                    ],
                    'callbacks' => [
                        'finish' => route('transactions.history'),
                    ]
                ];

                // Call Midtrans Snap API
                $response = Http::withHeaders([
                    'Authorization' => $authHeader,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])->post($midtransUrl, $payload);

                if (!$response->successful()) {
                    Log::error('Midtrans API Request Failed: ' . $response->body());
                    throw new \Exception('Gagal menghubungi server pembayaran Midtrans. Hubungi Admin.');
                }

                $responseJson = $response->json();
                $token = $responseJson['token'];
                $midtransRedirectUrl = $responseJson['redirect_url'];

                // Save token and redirect URL
                $transaction->update([
                    'midtrans_snap_token' => $token,
                    'midtrans_payment_url' => $midtransRedirectUrl,
                ]);

                // 6. Clear Cart Session
                session()->forget('cart');

                return [
                    'type' => 'transfer',
                    'url' => $midtransRedirectUrl
                ];
            });

            if ($result['type'] === 'cash') {
                return redirect()->route('transactions.history')->with('success', 'Pesanan Anda berhasil ditempatkan! Silakan lakukan pembayaran cash di kasir saat mengambil barang.');
            }

            return redirect()->away($result['url']);

        } catch (\Exception $e) {
            Log::error('Checkout Error: ' . $e->getMessage());
            return redirect()->route('checkout.index')->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }

    public function paymentNotification(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-YOUR_SERVER_KEY');
        $statusCode = $request->status_code;
        $grossAmount = $request->gross_amount;
        $orderId = $request->order_id;
        $signatureKey = $request->signature_key;

        // Verify Midtrans Webhook Signature
        $computedSignature = hash("sha512", $orderId . $statusCode . $grossAmount . $serverKey);
        if ($computedSignature !== $signatureKey) {
            Log::warning('Midtrans Webhook: Signature verification failed.', ['order_id' => $orderId]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Find transaction
        $transaction = Transaction::where('invoice_number', $orderId)->first();
        if (!$transaction) {
            Log::warning('Midtrans Webhook: Transaction not found.', ['order_id' => $orderId]);
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $transactionStatus = $request->transaction_status;
        $fraudStatus = $request->fraud_status;

        $newStatus = 'pending';

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $newStatus = 'pending';
            } else if ($fraudStatus == 'accept') {
                $newStatus = 'paid';
            }
        } else if ($transactionStatus == 'settlement') {
            $newStatus = 'paid';
        } else if (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
            $newStatus = 'cancelled';
            
            // Restore inventory stock
            DB::transaction(function () use ($transaction) {
                foreach ($transaction->details as $detail) {
                    if ($detail->product) {
                        $detail->product->increment('stock', $detail->quantity);
                        $detail->product->decrement('sold_count', $detail->quantity);
                    }
                }
            });
        } else if ($transactionStatus == 'pending') {
            $newStatus = 'pending';
        }

        $transaction->update([
            'status' => $newStatus,
        ]);

        Log::info("Midtrans Webhook: Invoice {$orderId} status updated to {$newStatus}");

        return response()->json(['message' => 'Notification processed successfully']);
    }
}
