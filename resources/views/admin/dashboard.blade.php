@extends('admin.layout')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Dashboard Overview</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">Ringkasan performa toko, inventaris kritis, dan peringatan obat hewan.</p>
    </div>
    <div class="flex items-center gap-3">
        <span class="text-xs text-slate-400 font-medium">Data diperbarui: {{ now()->format('d M Y, H:i') }}</span>
        <button onclick="window.location.reload();" class="p-2 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors shadow-sm" title="Refresh Data">
            <i data-lucide="refresh-cw" class="w-4 h-4"></i>
        </button>
    </div>
</div>

<!-- 4 Grid Stat Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Stat 1: Total Sales -->
    <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group">
        <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-emerald-500/5 rounded-full group-hover:scale-125 transition-transform duration-500"></div>
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                <i data-lucide="dollar-sign" class="w-6 h-6"></i>
            </div>
            <span class="inline-flex items-center gap-0.5 text-xs font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/50 px-2 py-1 rounded-full">
                <i data-lucide="trending-up" class="w-3.5 h-3.5"></i>
                12.5%
            </span>
        </div>
        <span class="text-xs font-medium text-slate-400 uppercase tracking-wider block">Total Pendapatan</span>
        <h3 class="text-2xl font-extrabold text-slate-900 dark:text-white mt-1">Rp {{ number_format($totalSales, 0, ',', '.') }}</h3>
        <p class="text-xs text-slate-400 mt-2">Dari seluruh transaksi terbayar</p>
    </div>

    <!-- Stat 2: New Orders -->
    <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group">
        <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-blue-500/5 rounded-full group-hover:scale-125 transition-transform duration-500"></div>
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-950/30 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                <i data-lucide="shopping-bag" class="w-6 h-6"></i>
            </div>
            @if($newOrdersCount > 0)
                <span class="inline-flex items-center text-xs font-semibold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/50 px-2.5 py-1 rounded-full animate-pulse">
                    Baru
                </span>
            @endif
        </div>
        <span class="text-xs font-medium text-slate-400 uppercase tracking-wider block">Pesanan Baru</span>
        <h3 class="text-2xl font-extrabold text-slate-900 dark:text-white mt-1">{{ $newOrdersCount }}</h3>
        <p class="text-xs text-slate-400 mt-2">Menunggu persetujuan resep/proses</p>
    </div>

    <!-- Stat 3: Low Stock Warning -->
    <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group">
        <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-amber-500/5 rounded-full group-hover:scale-125 transition-transform duration-500"></div>
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-950/30 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                <i data-lucide="alert-triangle" class="w-6 h-6"></i>
            </div>
            @if($lowStockCount > 0)
                <span class="inline-flex items-center text-xs font-semibold text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/50 px-2 py-0.5 rounded-full">
                    Kritis
                </span>
            @endif
        </div>
        <span class="text-xs font-medium text-slate-400 uppercase tracking-wider block">Stok Kritis (≤ 5)</span>
        <h3 class="text-2xl font-extrabold {{ $lowStockCount > 0 ? 'text-amber-600 dark:text-amber-400' : 'text-slate-900 dark:text-white' }} mt-1">{{ $lowStockCount }} <span class="text-xs font-normal text-slate-400">produk</span></h3>
        <p class="text-xs text-slate-400 mt-2">Perlu pemesanan ulang segera</p>
    </div>

    <!-- Stat 4: Expiring Products Warning -->
    <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group">
        <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-rose-500/5 rounded-full group-hover:scale-125 transition-transform duration-500"></div>
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 rounded-xl bg-rose-50 dark:bg-rose-950/30 text-rose-600 dark:text-rose-400 flex items-center justify-center">
                <i data-lucide="calendar-off" class="w-6 h-6"></i>
            </div>
            @if($expiringProductsCount > 0)
                <span class="inline-flex items-center text-xs font-semibold text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-950/50 px-2 py-0.5 rounded-full">
                    Segera
                </span>
            @endif
        </div>
        <span class="text-xs font-medium text-slate-400 uppercase tracking-wider block">Mendekati Kadaluarsa</span>
        <h3 class="text-2xl font-extrabold {{ $expiringProductsCount > 0 ? 'text-rose-600 dark:text-rose-400' : 'text-slate-900 dark:text-white' }} mt-1">{{ $expiringProductsCount }} <span class="text-xs font-normal text-slate-400">produk</span></h3>
        <p class="text-xs text-slate-400 mt-2">Kadaluarsa dalam waktu 60 hari</p>
    </div>
</div>

<!-- Main Area: Left Widgets (Chart & Table) & Right Widget (Expiring alerts) -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column: Chart & Recent Orders -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Sales Trend Chart Card -->
        <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm p-6">
            <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100 dark:border-slate-700">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Grafik Tren Penjualan Bulanan</h3>
                    <p class="text-xs text-slate-400">Statistik penjualan farmasi hewan tahun ini</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 text-xs text-emerald-600 dark:text-emerald-400 font-medium">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        Obat Hewan
                    </span>
                </div>
            </div>
            
            <!-- Elegant Interactive SVG Line/Area Chart Placeholder -->
            <div class="h-64 relative w-full flex items-end">
                <svg viewBox="0 0 500 200" class="w-full h-full overflow-visible">
                    <defs>
                        <linearGradient id="chartGrad" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#10b981" stop-opacity="0.25" />
                            <stop offset="100%" stop-color="#10b981" stop-opacity="0" />
                        </linearGradient>
                    </defs>
                    
                    <!-- Grid Lines -->
                    <line x1="0" y1="40" x2="500" y2="40" stroke="#f1f5f9" stroke-width="1" class="dark:stroke-slate-700/50" />
                    <line x1="0" y1="90" x2="500" y2="90" stroke="#f1f5f9" stroke-width="1" class="dark:stroke-slate-700/50" />
                    <line x1="0" y1="140" x2="500" y2="140" stroke="#f1f5f9" stroke-width="1" class="dark:stroke-slate-700/50" />
                    <line x1="0" y1="190" x2="500" y2="190" stroke="#e2e8f0" stroke-width="1.5" class="dark:stroke-slate-700" />
                    
                    <!-- Area Path (Filled gradient under line) -->
                    <path d="M 0 160 Q 50 140 100 130 T 200 90 T 300 120 T 400 60 T 500 45 L 500 190 L 0 190 Z" fill="url(#chartGrad)" />
                    
                    <!-- Line Path -->
                    <path d="M 0 160 Q 50 140 100 130 T 200 90 T 300 120 T 400 60 T 500 45" fill="none" stroke="#10b981" stroke-width="3" stroke-linecap="round" />
                    
                    <!-- Points -->
                    <circle cx="100" cy="130" r="4.5" fill="#ffffff" stroke="#10b981" stroke-width="2.5" />
                    <circle cx="200" cy="90" r="4.5" fill="#ffffff" stroke="#10b981" stroke-width="2.5" />
                    <circle cx="300" cy="120" r="4.5" fill="#ffffff" stroke="#10b981" stroke-width="2.5" />
                    <circle cx="400" cy="60" r="4.5" fill="#ffffff" stroke="#10b981" stroke-width="2.5" />
                    <circle cx="500" cy="45" r="4.5" fill="#ffffff" stroke="#10b981" stroke-width="2.5" />
                </svg>
            </div>
            <div class="flex justify-between text-[11px] text-slate-400 mt-3 font-semibold uppercase tracking-wider">
                <span>Jan</span>
                <span>Mar</span>
                <span>Mei</span>
                <span>Jul</span>
                <span>Sep</span>
                <span>Nov</span>
                <span>Des</span>
            </div>
        </div>

        <!-- Recent Transactions Table Card -->
        <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                        <i data-lucide="receipt" class="w-4.5 h-4.5"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">Transaksi Terbaru</h3>
                        <p class="text-xs text-slate-400">Daftar invoice pesanan yang masuk</p>
                    </div>
                </div>
                <a href="{{ route('admin.transaction.index') }}" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300 flex items-center gap-1">
                    Lihat Semua
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900/50 text-slate-500 dark:text-slate-400 border-b border-slate-100 dark:border-slate-800 text-xs font-bold uppercase tracking-wider">
                            <th class="px-6 py-4">No. Invoice</th>
                            <th class="px-6 py-4">Pelanggan</th>
                            <th class="px-6 py-4">Target Hewan</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @forelse($recentTransactions as $tx)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4 font-bold text-slate-900 dark:text-white whitespace-nowrap">
                                    {{ $tx->invoice_number }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-200 flex items-center justify-center font-bold text-xs">
                                            {{ strtoupper(substr($tx->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-slate-800 dark:text-slate-200">{{ $tx->user->name }}</p>
                                            <p class="text-xs text-slate-400">{{ $tx->created_at->format('d M Y, H:i') }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        // Collect all unique target animals from products inside this transaction
                                        $targets = [];
                                        foreach($tx->details as $d) {
                                            if($d->product && $d->product->target_animals) {
                                                $prodTargets = explode(', ', $d->product->target_animals);
                                                $targets = array_unique(array_merge($targets, $prodTargets));
                                            }
                                        }
                                    @endphp
                                    
                                    @if(count($targets) > 0)
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($targets as $target)
                                                <span class="inline-flex items-center text-[10px] font-bold bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 px-2 py-0.5 rounded-md">
                                                    {{ $target }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Umum</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-semibold text-slate-900 dark:text-white whitespace-nowrap">
                                    Rp {{ number_format($tx->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($tx->status === 'pending')
                                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold bg-amber-50 dark:bg-amber-950/30 text-amber-600 dark:text-amber-400 px-2.5 py-1 rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Pending
                                        </span>
                                    @elseif($tx->status === 'paid')
                                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 px-2.5 py-1 rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Lunas
                                        </span>
                                    @elseif($tx->status === 'shipped')
                                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold bg-blue-50 dark:bg-blue-950/30 text-blue-600 dark:text-blue-400 px-2.5 py-1 rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                            Dikirim
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold bg-rose-50 dark:bg-rose-950/30 text-rose-600 dark:text-rose-400 px-2.5 py-1 rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            Batal
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <a class="inline-flex items-center gap-1 text-xs font-bold text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300 border border-emerald-100 dark:border-emerald-900 bg-emerald-50/50 dark:bg-emerald-950/10 px-3 py-1.5 rounded-lg transition-colors" href="{{ route('admin.transaction.show', $tx->id) }}">
                                        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-400 dark:text-slate-500">
                                    <i data-lucide="inbox" class="w-10 h-10 mx-auto text-slate-300 dark:text-slate-600 mb-3"></i>
                                    <p class="font-medium text-sm">Belum ada transaksi saat ini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Right Column: Expiring Medicine Alert Box Widget -->
    <div id="expiry-alert" class="space-y-6">
        <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm p-6">
            <div class="flex items-center gap-2.5 pb-4 mb-4 border-b border-slate-100 dark:border-slate-700">
                <div class="w-8 h-8 rounded-lg bg-rose-50 dark:bg-rose-950/30 text-rose-600 dark:text-rose-400 flex items-center justify-center">
                    <i data-lucide="clock" class="w-4.5 h-4.5"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Alert Kadaluarsa Obat</h3>
                    <p class="text-xs text-slate-400">Mendekati kedaluwarsa ≤ 60 hari</p>
                </div>
            </div>

            <!-- List of expiring products -->
            <div class="space-y-4">
                @forelse($expiringProductsList as $prod)
                    @php
                        $daysLeft = now()->diffInDays($prod->expiry_date, false);
                        $isExpired = $daysLeft < 0;
                    @endphp
                    <div class="flex gap-3 p-3.5 rounded-xl border {{ $isExpired ? 'border-rose-100 bg-rose-50/50 dark:border-rose-950/20 dark:bg-rose-950/5' : 'border-amber-100 bg-amber-50/30 dark:border-amber-950/10 dark:bg-amber-950/5' }} transition-colors">
                        <div class="w-10 h-10 rounded-lg overflow-hidden bg-slate-100 dark:bg-slate-700 flex-shrink-0">
                            @if(Str::startsWith($prod->image, 'http'))
                                <img src="{{ $prod->image }}" alt="{{ $prod->name }}" class="w-full h-full object-cover" />
                            @else
                                <img src="{{ asset($prod->image) }}" alt="{{ $prod->name }}" class="w-full h-full object-cover" />
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <h4 class="text-xs font-bold text-slate-900 dark:text-white truncate">{{ $prod->name }}</h4>
                            <p class="text-[10px] text-slate-400 font-semibold mt-0.5">Batch: {{ $prod->batch_number ?? '-' }} | Izin: {{ $prod->registration_number ?? '-' }}</p>
                            
                            <!-- Badges target hewan -->
                            @if($prod->target_animals)
                                <div class="flex flex-wrap gap-1 mt-1.5">
                                    @foreach(explode(', ', $prod->target_animals) as $tag)
                                        <span class="text-[9px] font-bold bg-white/80 dark:bg-slate-800 text-slate-600 dark:text-slate-300 px-1.5 py-0.5 rounded border border-slate-100 dark:border-slate-700">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <div class="flex items-center justify-between mt-2.5 pt-2 border-t border-slate-100 dark:border-slate-700/50">
                                <span class="text-[10px] font-medium text-slate-400">Tgl: {{ $prod->expiry_date->format('d M Y') }}</span>
                                @if($isExpired)
                                    <span class="text-[10px] font-bold text-rose-600 dark:text-rose-400">
                                        Sudah Kadaluarsa
                                    </span>
                                @else
                                    <span class="text-[10px] font-bold {{ $daysLeft <= 30 ? 'text-rose-600 dark:text-rose-400' : 'text-amber-600 dark:text-amber-400' }}">
                                        {{ $daysLeft }} hari lagi
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 rounded-xl border border-dashed border-slate-200 dark:border-slate-700 text-center text-slate-400 dark:text-slate-500">
                        <i data-lucide="check-circle-2" class="w-8 h-8 mx-auto text-emerald-500 mb-2"></i>
                        <p class="font-bold text-xs text-slate-800 dark:text-white">Aman & Terkendali</p>
                        <p class="text-[10px] mt-1">Tidak ada produk yang mendekati tanggal kadaluarsa.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-700 text-center">
                <a href="{{ route('admin.product.index') }}" class="text-[11px] font-bold text-slate-500 hover:text-emerald-600 dark:text-slate-400 dark:hover:text-emerald-400 flex items-center justify-center gap-1.5">
                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                    Kelola Stok &amp; Tanggal Kadaluarsa
                </a>
            </div>
        </div>
        
        <!-- Quick Informative Card for Veterinary Pharmacist -->
        <div class="bg-gradient-to-tr from-slate-900 to-slate-800 text-white rounded-2xl p-6 shadow-md relative overflow-hidden group">
            <div class="absolute right-0 bottom-0 translate-x-4 translate-y-4 opacity-5 pointer-events-none">
                <i data-lucide="paw-print" class="w-40 h-40"></i>
            </div>
            <h3 class="text-sm font-bold tracking-wide uppercase text-emerald-400 mb-2">Info Regulasi Obat Hewan</h3>
            <p class="text-xs text-slate-300 leading-relaxed">
                Berdasarkan regulasi Kementerian Pertanian RI, setiap obat hewan yang disalurkan wajib memiliki nomor batch yang terdaftar dan nomor pendaftaran BPOM/Kementan RI. Untuk <strong>Golongan Obat Keras / Resep Dokter Hewan</strong>, pastikan resep diunggah dan diverifikasi sebelum pengiriman.
            </p>
            <div class="mt-4 flex gap-2">
                <span class="text-[10px] font-bold bg-slate-800 text-slate-300 px-2.5 py-1 rounded-lg">Kementan RI</span>
                <span class="text-[10px] font-bold bg-slate-800 text-slate-300 px-2.5 py-1 rounded-lg">ASOHI</span>
            </div>
        </div>
    </div>
</div>
@endsection
