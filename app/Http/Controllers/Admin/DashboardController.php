<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = Transaction::whereIn('status', ['paid', 'shipped'])->sum('total_price');
        $productsCount = Product::count();
        $transactionsCount = Transaction::count();
        $customersCount = User::where('role', 'customer')->count();

        $newOrdersCount = Transaction::where('status', 'pending')->count();
        $lowStockCount = Product::where('stock', '<=', 5)->count();
        
        $expiringProductsCount = Product::whereNotNull('expiry_date')
            ->where('expiry_date', '<=', now()->addDays(60))
            ->count();

        $expiringProductsList = Product::whereNotNull('expiry_date')
            ->where('expiry_date', '<=', now()->addDays(60))
            ->orderBy('expiry_date', 'asc')
            ->limit(5)
            ->get();

        $recentTransactions = Transaction::with(['user', 'details.product'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalSales',
            'productsCount',
            'transactionsCount',
            'customersCount',
            'newOrdersCount',
            'lowStockCount',
            'expiringProductsCount',
            'expiringProductsList',
            'recentTransactions'
        ));
    }
}
