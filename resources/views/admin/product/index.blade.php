@extends('admin.layout')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Katalog Produk Obat Hewan</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">Kelola dan pantau seluruh obat, vaksin, dan suplemen hewan yang aktif.</p>
    </div>
    <a href="{{ route('admin.product.create') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2.5 rounded-xl text-sm transition-all shadow-sm hover:shadow-emerald-600/10">
        <i data-lucide="plus" class="w-4 h-4"></i>
        Tambah Produk Baru
    </a>
</div>

<!-- Alert notifications -->
@if(session('success'))
    <div class="flex items-center gap-3 p-4 bg-emerald-50 dark:bg-emerald-950/20 text-emerald-800 dark:text-emerald-300 rounded-xl border border-emerald-100 dark:border-emerald-900/50 text-sm">
        <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 dark:text-emerald-400 flex-shrink-0"></i>
        <div class="font-medium">{{ session('success') }}</div>
    </div>
@endif

<!-- Products Table Container -->
<div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
        <h3 class="text-base font-bold text-slate-900 dark:text-white">Daftar Produk</h3>
        <span class="text-xs font-semibold bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 px-3 py-1 rounded-full">{{ count($products) }} Total</span>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-slate-50 dark:bg-slate-900/50 text-slate-500 dark:text-slate-400 border-b border-slate-100 dark:border-slate-800 text-xs font-bold uppercase tracking-wider">
                    <th class="px-6 py-4 w-20">Foto</th>
                    <th class="px-6 py-4">Nama Produk &amp; Produsen</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Spesies Target</th>
                    <th class="px-6 py-4">Harga</th>
                    <th class="px-6 py-4">Stok</th>
                    <th class="px-6 py-4">Batch &amp; Expiry</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($products as $prod)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                        <td class="px-6 py-4">
                            <div class="w-12 h-12 rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-700 border border-slate-100 dark:border-slate-700 flex-shrink-0">
                                @if(Str::startsWith($prod->image, 'http'))
                                    <img src="{{ $prod->image }}" alt="{{ $prod->name }}" class="w-full h-full object-cover" />
                                @else
                                    <img src="{{ asset($prod->image) }}" alt="{{ $prod->name }}" class="w-full h-full object-cover" />
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="max-w-xs md:max-w-sm truncate">
                                <p class="font-bold text-slate-900 dark:text-white text-sm flex items-center gap-1.5">
                                    {{ $prod->name }}
                                    @if($prod->needs_prescription)
                                        <span class="inline-flex items-center text-[9px] font-bold bg-rose-50 dark:bg-rose-950/30 text-rose-600 dark:text-rose-400 px-1.5 py-0.5 rounded" title="Butuh Resep Dokter Hewan">
                                            R/
                                        </span>
                                    @endif
                                </p>
                                <p class="text-xs text-slate-400 mt-0.5 font-medium">Merek/Produsen: {{ $prod->brand ?? 'Tidak ada merek' }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-slate-600 dark:text-slate-300">
                            {{ $prod->category->name }}
                        </td>
                        <td class="px-6 py-4">
                            @if($prod->target_animals)
                                <div class="flex flex-wrap gap-1 max-w-[150px]">
                                    @foreach(explode(', ', $prod->target_animals) as $animal)
                                        <span class="inline-flex items-center text-[10px] font-bold bg-emerald-50 dark:bg-emerald-950/20 text-emerald-700 dark:text-emerald-400 px-2 py-0.5 rounded border border-emerald-100 dark:border-emerald-900/50">
                                            {{ $animal }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-xs text-slate-400 italic">Umum</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold text-slate-900 dark:text-white whitespace-nowrap">
                            Rp {{ number_format($prod->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($prod->stock <= 5)
                                <span class="inline-flex items-center gap-1 text-xs font-bold text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-950/30 px-2.5 py-1 rounded-full">
                                    {{ $prod->stock }} unit (Kritis)
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/30 px-2.5 py-1 rounded-full">
                                    {{ $prod->stock }} unit
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($prod->expiry_date)
                                <p class="text-xs font-semibold {{ $prod->expiry_date->isPast() || now()->diffInDays($prod->expiry_date, false) <= 60 ? 'text-rose-600 dark:text-rose-400 font-bold' : 'text-slate-600 dark:text-slate-300' }}">
                                    EXP: {{ $prod->expiry_date->format('d M Y') }}
                                </p>
                                <p class="text-[10px] text-slate-400 font-medium">Batch: {{ $prod->batch_number ?? '-' }}</p>
                            @else
                                <span class="text-xs text-slate-400 italic">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <div class="flex items-center justify-center gap-2">
                                <a class="inline-flex items-center gap-1 text-xs font-bold text-amber-600 hover:text-white border border-amber-100 hover:border-amber-600 hover:bg-amber-600 px-3 py-1.5 rounded-lg transition-colors" href="{{ route('admin.product.edit', $prod->id) }}">
                                    <i data-lucide="edit" class="w-3.5 h-3.5"></i>
                                    Edit
                                </a>
                                <form action="{{ route('admin.product.destroy', $prod->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk obat ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 text-xs font-bold text-rose-600 hover:text-white border border-rose-100 hover:border-rose-600 hover:bg-rose-600 px-3 py-1.5 rounded-lg transition-colors">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-slate-400 dark:text-slate-500">
                            <i data-lucide="package-x" class="w-12 h-12 mx-auto text-slate-300 dark:text-slate-600 mb-3"></i>
                            <p class="font-bold text-sm">Belum ada produk obat yang terdaftar.</p>
                            <p class="text-xs mt-1">Gunakan tombol "Tambah Produk Baru" untuk menambahkan obat.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
