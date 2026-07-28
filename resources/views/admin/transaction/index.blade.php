@extends('admin.layout')

@section('content')
<!-- Page Header -->
<div class="py-2 border-b border-slate-100 dark:border-slate-800">
    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Daftar Transaksi Masuk</h1>
    <p class="text-sm text-slate-500 dark:text-slate-400">Pantau, verifikasi, dan perbarui status pesanan obat hewan pelanggan.</p>
</div>

<!-- Notifications -->
@if(session('success'))
    <div class="flex items-center gap-3 p-4 bg-emerald-50 dark:bg-emerald-950/20 text-emerald-800 dark:text-emerald-300 rounded-xl border border-emerald-100 dark:border-emerald-900/50 text-sm mt-4">
        <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 dark:text-emerald-400 flex-shrink-0"></i>
        <div class="font-medium">{{ session('success') }}</div>
    </div>
@endif

<!-- Transactions Table Card -->
<div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm overflow-hidden mt-6">
    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
        <h3 class="text-base font-bold text-slate-900 dark:text-white">Semua Transaksi</h3>
        <span class="text-xs font-semibold bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 px-3 py-1 rounded-full">{{ count($transactions) }} Invoice</span>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-slate-50 dark:bg-slate-900/50 text-slate-500 dark:text-slate-400 border-b border-slate-100 dark:border-slate-800 text-xs font-bold uppercase tracking-wider">
                    <th class="px-6 py-4">No. Invoice</th>
                    <th class="px-6 py-4">Pelanggan</th>
                    <th class="px-6 py-4">Total Pembayaran</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Metode Transfer</th>
                    <th class="px-6 py-4">Tanggal Masuk</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($transactions as $tx)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                        <td class="px-6 py-4 font-bold text-slate-900 dark:text-white whitespace-nowrap">
                            {{ $tx->invoice_number }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-200 flex items-center justify-center font-bold text-xs">
                                    {{ strtoupper(substr($tx->user->name, 0, 1)) }}
                                </div>
                                <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $tx->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-semibold text-slate-900 dark:text-white whitespace-nowrap">
                            Rp {{ number_format($tx->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($tx->status === 'pending')
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold bg-amber-50 dark:bg-amber-950/30 text-amber-600 dark:text-amber-400 px-2.5 py-1 rounded-full border border-amber-100 dark:border-amber-900/30">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Pending
                                </span>
                            @elseif($tx->status === 'paid')
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 px-2.5 py-1 rounded-full border border-emerald-100 dark:border-emerald-900/30">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Lunas
                                </span>
                            @elseif($tx->status === 'shipped')
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold bg-blue-50 dark:bg-blue-950/30 text-blue-600 dark:text-blue-400 px-2.5 py-1 rounded-full border border-blue-100 dark:border-blue-900/30">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                    Dikirim
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold bg-rose-50 dark:bg-rose-950/30 text-rose-600 dark:text-rose-400 px-2.5 py-1 rounded-full border border-rose-100 dark:border-rose-900/30">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                    Batal
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-slate-600 dark:text-slate-300">
                            {{ $tx->notes ? explode(' | ', $tx->notes)[0] : 'Transfer Bank' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-slate-500 dark:text-slate-400">
                            {{ $tx->created_at->format('d M Y, H:i') }} WIB
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <a class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 hover:text-white border border-emerald-100 hover:border-emerald-600 hover:bg-emerald-600 px-3 py-1.5 rounded-lg transition-colors" href="{{ route('admin.transaction.show', $tx->id) }}">
                                <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                Detail Pesanan
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-slate-400 dark:text-slate-500">
                            <i data-lucide="shopping-bag" class="w-12 h-12 mx-auto text-slate-300 dark:text-slate-600 mb-3"></i>
                            <p class="font-bold text-sm">Belum ada transaksi masuk.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
