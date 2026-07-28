@extends('layout')

@section('content')
    <main class="max-w-4xl mx-auto px-margin-mobile md:px-margin-desktop py-md min-h-screen">
        <h1 class="text-2xl font-bold mb-6 text-on-surface flex items-center gap-xs">
            <span class="material-symbols-outlined text-primary">history</span>
            Riwayat Transaksi Saya
        </h1>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6 text-sm font-semibold shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-6">
            @forelse($transactions as $tx)
                <!-- Transaction Card -->
                <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant overflow-hidden">
                    <!-- Header -->
                    <div class="p-md bg-surface-container-low flex flex-col md:flex-row md:items-center justify-between border-b border-outline-variant gap-sm">
                        <div>
                            <span class="text-caption text-on-surface-variant block">No. Invoice</span>
                            <span class="font-bold text-on-surface">{{ $tx->invoice_number }}</span>
                        </div>
                        <div class="flex flex-wrap items-center gap-md">
                            <div>
                                <span class="text-caption text-on-surface-variant block">Tanggal Pembelian</span>
                                <span class="text-body-md font-medium">{{ $tx->created_at->format('d M Y, H:i') }} WIB</span>
                            </div>
                            <div>
                                <span class="text-caption text-on-surface-variant block">Status</span>
                                @if($tx->status === 'pending')
                                    <span class="inline-block bg-yellow-50 text-yellow-700 border border-yellow-200 text-xs px-2.5 py-1 rounded-full font-semibold">Pending</span>
                                @elseif($tx->status === 'paid')
                                    <span class="inline-block bg-green-50 text-green-700 border border-green-200 text-xs px-2.5 py-1 rounded-full font-semibold">Lunas</span>
                                @elseif($tx->status === 'shipped')
                                    <span class="inline-block bg-blue-50 text-blue-700 border border-blue-200 text-xs px-2.5 py-1 rounded-full font-semibold">Dikirim</span>
                                @else
                                    <span class="inline-block bg-red-50 text-red-700 border border-red-200 text-xs px-2.5 py-1 rounded-full font-semibold">Dibatalkan</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Items List -->
                    <div class="divide-y divide-surface-container">
                        @foreach($tx->details as $item)
                            <div class="p-md flex gap-md items-center">
                                <div class="w-16 h-16 rounded-lg bg-surface-container-low overflow-hidden flex-shrink-0 border">
                                    @if(Str::startsWith($item->product->image, 'http'))
                                        <img class="w-full h-full object-cover" src="{{ $item->product->image }}" alt="{{ $item->product->name }}" />
                                    @else
                                        <img class="w-full h-full object-cover" src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" />
                                    @endif
                                </div>
                                <div class="flex-grow min-w-0">
                                    <h4 class="font-semibold text-body-md text-on-surface truncate">
                                        <a href="{{ route('product.show', $item->product->slug) }}" class="hover:text-primary transition-colors">
                                            {{ $item->product->name }}
                                        </a>
                                    </h4>
                                    <p class="text-caption text-on-surface-variant mt-0.5">
                                        Rp {{ number_format($item->price, 0, ',', '.') }} x {{ $item->quantity }}
                                    </p>
                                </div>
                                <div class="text-right shrink-0">
                                    <p class="font-bold text-on-surface">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Footer / Summary -->
                    <div class="p-md bg-surface-container-lowest border-t border-outline-variant flex flex-col md:flex-row md:items-center justify-between gap-sm">
                        <div class="text-caption text-on-surface-variant space-y-0.5">
                            <p>Metode Pembayaran / Kurir: <span class="font-semibold text-on-surface">{{ $tx->notes }}</span></p>
                            <p>Alamat Pengiriman: <span class="font-medium text-on-surface line-clamp-1">{{ $tx->shipping_address }}</span></p>
                        </div>
                        <div class="text-right">
                            <span class="text-caption text-on-surface-variant block">Total Pembayaran</span>
                            <span class="text-lg font-extrabold text-primary">Rp {{ number_format($tx->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-xl text-center shadow-sm">
                    <span class="material-symbols-outlined text-[64px] text-outline mb-4">receipt_long</span>
                    <h3 class="font-headline-md text-headline-md text-on-surface mb-2">Belum Ada Transaksi</h3>
                    <p class="font-body-md text-on-surface-variant max-w-sm mx-auto mb-6">
                        Anda belum melakukan pembelian apa pun. Silakan jelajahi produk kami dan lakukan pemesanan pertamamu!
                    </p>
                    <a href="{{ route('home') }}" class="px-6 py-2.5 bg-primary text-white font-label-md text-label-md rounded-lg hover:opacity-90 transition-all shadow-sm">
                        Mulai Belanja
                    </a>
                </div>
            @endforelse
        </div>
    </main>
@endsection
