@extends('admin.layout')

@section('content')
<!-- Page Header -->
<div class="flex items-center gap-4 py-2 border-b border-slate-100 dark:border-slate-800">
    <a href="{{ route('admin.transaction.index') }}" class="p-2 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors shadow-sm">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Detail Transaksi</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">Verifikasi item pembelian, data penerima, dan perbarui status pengiriman.</p>
    </div>
</div>

<!-- Notification -->
@if(session('success'))
    <div class="flex items-center gap-3 p-4 bg-emerald-50 dark:bg-emerald-950/20 text-emerald-800 dark:text-emerald-300 rounded-xl border border-emerald-100 dark:border-emerald-900/50 text-sm mt-4">
        <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 dark:text-emerald-400 flex-shrink-0"></i>
        <div class="font-medium">{{ session('success') }}</div>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-6">
    <!-- Left Column (Span 8): Items & Recipient Info -->
    <div class="lg:col-span-8 space-y-6">
        
        <!-- Ordered Items Card -->
        <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
                <h3 class="text-base font-bold text-slate-900 dark:text-white">Invoice: {{ $transaction->invoice_number }}</h3>
                <span class="text-xs text-slate-400 font-semibold">{{ $transaction->created_at->format('d M Y, H:i') }} WIB</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900/50 text-slate-500 dark:text-slate-400 border-b border-slate-100 dark:border-slate-800 text-xs font-bold uppercase tracking-wider">
                            <th class="px-6 py-4 w-16">Foto</th>
                            <th class="px-6 py-4">Nama Produk Obat</th>
                            <th class="px-6 py-4">Harga Satuan</th>
                            <th class="px-6 py-4 text-center">Jumlah</th>
                            <th class="px-6 py-4 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach($transaction->details as $item)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="w-10 h-10 rounded-lg overflow-hidden bg-slate-100 dark:bg-slate-700 border border-slate-100 dark:border-slate-700 flex-shrink-0">
                                        @if(Str::startsWith($item->product->image, 'http'))
                                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover" />
                                        @else
                                            <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover" />
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-slate-900 dark:text-white text-sm flex items-center gap-1.5">
                                        {{ $item->product->name }}
                                        @if($item->product->needs_prescription)
                                            <span class="inline-flex items-center text-[9px] font-bold bg-rose-50 dark:bg-rose-950/30 text-rose-600 dark:text-rose-400 px-1.5 py-0.5 rounded">
                                                R/
                                            </span>
                                        @endif
                                    </p>
                                    @if($item->product->target_animals)
                                        <p class="text-[10px] text-slate-400 font-semibold mt-0.5">Spesies: {{ $item->product->target_animals }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-300 whitespace-nowrap">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-center text-slate-600 dark:text-slate-300 font-semibold">
                                    {{ $item->quantity }} unit
                                </td>
                                <td class="px-6 py-4 text-right font-bold text-slate-900 dark:text-white whitespace-nowrap">
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Total Cost Breakdown -->
            <div class="px-6 py-5 bg-slate-50/50 dark:bg-slate-900/20 border-t border-slate-100 dark:border-slate-700/80">
                <div class="flex justify-end">
                    <div class="w-full md:w-80 space-y-2 text-sm">
                        <div class="flex justify-between text-slate-500 dark:text-slate-400">
                            <span>Subtotal Barang:</span>
                            <span class="font-semibold text-slate-700 dark:text-slate-300">Rp {{ number_format($transaction->total_price - $transaction->shipping_cost - $transaction->service_fee + $transaction->discount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-slate-500 dark:text-slate-400">
                            <span>Ongkos Kirim:</span>
                            <span class="font-semibold text-slate-700 dark:text-slate-300">Rp {{ number_format($transaction->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-slate-500 dark:text-slate-400">
                            <span>Biaya Layanan:</span>
                            <span class="font-semibold text-slate-700 dark:text-slate-300">Rp {{ number_format($transaction->service_fee, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-emerald-600 dark:text-emerald-400 font-semibold">
                            <span>Diskon Promo:</span>
                            <span>-Rp {{ number_format($transaction->discount, 0, ',', '.') }}</span>
                        </div>
                        <hr class="border-slate-100 dark:border-slate-700/80 my-2" />
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-slate-800 dark:text-white">Total Pembayaran:</span>
                            <span class="text-xl font-extrabold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recipient Information Card -->
        <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm p-6 space-y-4">
            <h3 class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-700 pb-3 flex items-center gap-2">
                <i data-lucide="truck" class="w-5 h-5 text-emerald-500"></i>
                Informasi Penerima &amp; Alamat Pengiriman
            </h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Nama Penerima</label>
                    <p class="font-bold text-slate-800 dark:text-white text-base">{{ $transaction->user->name }}</p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Nomor Telepon</label>
                    <p class="font-semibold text-slate-800 dark:text-white">{{ $transaction->user->phone ?? 'Tidak ada telepon terdaftar' }}</p>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Alamat Lengkap Tujuan</label>
                    <p class="font-medium text-slate-700 dark:text-slate-200 leading-relaxed bg-slate-50 dark:bg-slate-900/40 p-4 rounded-xl border border-slate-100 dark:border-slate-800">{{ $transaction->shipping_address }}</p>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Catatan Kurir &amp; Metode Pembayaran</label>
                    <p class="font-medium text-slate-600 dark:text-slate-300 italic">{{ $transaction->notes ?? 'Tidak ada catatan khusus' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column (Span 4): Status Editor -->
    <div class="lg:col-span-4 space-y-6">
        
        <!-- Status Control Widget -->
        <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm p-6 space-y-6">
            <h3 class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-700 pb-3 flex items-center gap-2">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500"></i>
                Status Pemesanan
            </h3>

            <!-- Current Status Badge -->
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Status Saat Ini</label>
                @if($transaction->status === 'pending')
                    <span class="inline-flex items-center gap-1.5 text-sm font-bold bg-amber-50 dark:bg-amber-950/30 text-amber-600 dark:text-amber-400 px-4 py-2 rounded-xl border border-amber-100 dark:border-amber-900/30 w-full justify-center">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                        Pending (Menunggu Pembayaran)
                    </span>
                @elseif($transaction->status === 'paid')
                    <span class="inline-flex items-center gap-1.5 text-sm font-bold bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 px-4 py-2 rounded-xl border border-emerald-100 dark:border-emerald-900/30 w-full justify-center">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Lunas (Menunggu Pengiriman)
                    </span>
                @elseif($transaction->status === 'shipped')
                    <span class="inline-flex items-center gap-1.5 text-sm font-bold bg-blue-50 dark:bg-blue-950/30 text-blue-600 dark:text-blue-400 px-4 py-2 rounded-xl border border-blue-100 dark:border-blue-900/30 w-full justify-center">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                        Dikirim (Dalam Perjalanan)
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 text-sm font-bold bg-rose-50 dark:bg-rose-950/30 text-rose-600 dark:text-rose-400 px-4 py-2 rounded-xl border border-rose-100 dark:border-rose-900/30 w-full justify-center">
                        <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                        Dibatalkan
                    </span>
                @endif
            </div>

            <!-- Status Form -->
            <form action="{{ route('admin.transaction.updateStatus', $transaction->id) }}" method="POST" class="space-y-4 pt-4 border-t border-slate-100 dark:border-slate-700">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="statusSelect" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Ubah Status Ke</label>
                    <select id="statusSelect" name="status" required class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all">
                        <option value="pending" {{ $transaction->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $transaction->status === 'paid' ? 'selected' : '' }}>Lunas</option>
                        <option value="shipped" {{ $transaction->status === 'shipped' ? 'selected' : '' }}>Dikirim</option>
                        <option value="cancelled" {{ $transaction->status === 'cancelled' ? 'selected' : '' }}>Batalkan</option>
                    </select>
                </div>
                
                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2.5 rounded-xl text-sm transition-all shadow-sm hover:shadow-emerald-600/10 flex items-center justify-center gap-2">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    Perbarui Status
                </button>
            </form>
        </div>

        <!-- Recipe Verification Placeholder (Veterinary Pharmacy Feature) -->
        <div class="bg-gradient-to-tr from-emerald-950 to-emerald-900 text-white rounded-2xl p-6 shadow-sm relative overflow-hidden">
            <div class="absolute right-0 bottom-0 translate-x-4 translate-y-4 opacity-5 pointer-events-none">
                <i data-lucide="prescription" class="w-40 h-40"></i>
            </div>
            <h3 class="text-sm font-bold tracking-wide uppercase text-emerald-400 mb-2 flex items-center gap-1.5">
                <i data-lucide="shield-check" class="w-4 h-4"></i>
                Verifikasi Resep Medis
            </h3>
            
            @php
                $hasPrescriptionObat = false;
                foreach($transaction->details as $item) {
                    if($item->product && $item->product->needs_prescription) {
                        $hasPrescriptionObat = true;
                        break;
                    }
                }
            @endphp
            
            @if($hasPrescriptionObat)
                <p class="text-xs text-emerald-100 leading-relaxed">
                    Transaksi ini berisi obat yang <strong>wajib menggunakan resep Dokter Hewan</strong>. Pastikan dokter hewan pengirim berlisensi terdaftar dan isi resep sesuai dosis order.
                </p>
                <div class="mt-4 p-3 bg-emerald-900/60 rounded-xl border border-emerald-800 text-xs flex items-center justify-between">
                    <span class="font-medium text-emerald-200">Unduh Resep Dokter</span>
                    <button class="bg-white hover:bg-slate-100 text-emerald-900 font-bold px-3 py-1.5 rounded-lg transition-colors flex items-center gap-1">
                        <i data-lucide="download" class="w-3.5 h-3.5"></i>
                        PDF
                    </button>
                </div>
            @else
                <p class="text-xs text-emerald-200/80 leading-relaxed">
                    Transaksi ini hanya berisi obat bebas, vitamin, atau suplemen. Tidak memerlukan verifikasi resep dokter hewan.
                </p>
                <div class="mt-4 p-3 bg-emerald-900/20 rounded-xl text-center text-xs border border-emerald-800/40 text-emerald-400 font-semibold">
                    Tidak Butuh Resep Dokter
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
