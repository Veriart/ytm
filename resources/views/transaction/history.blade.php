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
                                @elseif($tx->status === 'completed')
                                    <span class="inline-block bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs px-2.5 py-1 rounded-full font-semibold">Selesai</span>
                                @else
                                    <span class="inline-block bg-red-50 text-red-700 border border-red-200 text-xs px-2.5 py-1 rounded-full font-semibold">Dibatalkan</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Items List -->
                    <div class="divide-y divide-surface-container">
                        @foreach($tx->details as $item)
                            <div class="p-md flex flex-col gap-sm">
                                <div class="flex gap-md items-center w-full">
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
                                
                                @if($tx->status === 'completed')
                                    @php
                                        $hasReviewed = \App\Models\Review::where('user_id', Auth::id())
                                            ->where('product_id', $item->product->id)
                                            ->where('transaction_id', $tx->id)
                                            ->exists();
                                    @endphp
                                    <div class="flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/10 p-2 rounded-xl border border-slate-100/50 mt-1">
                                        <span class="text-xs text-slate-400 font-semibold">Ulasan Produk</span>
                                        @if($hasReviewed)
                                            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-100">
                                                <span class="material-symbols-outlined text-[14px]">done</span> Sudah Diulas
                                            </span>
                                        @else
                                            <button onclick="toggleReviewForm({{ $tx->id }}, {{ $item->product->id }})" class="inline-flex items-center gap-1 px-2.5 py-1 bg-amber-50 hover:bg-amber-100 text-amber-700 rounded-lg text-[11px] font-bold border border-amber-200 transition-all">
                                                <span class="material-symbols-outlined text-[13px]">rate_review</span> Beri Ulasan
                                            </button>
                                        @endif
                                    </div>

                                    @if(!$hasReviewed)
                                        <div id="review-form-{{ $tx->id }}-{{ $item->product->id }}" class="hidden p-4 bg-slate-50 rounded-xl border border-slate-100 text-left mt-2 space-y-3">
                                            <h5 class="text-xs font-bold text-slate-700 flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[16px] text-amber-500">star</span>
                                                Ulas Produk: {{ $item->product->name }}
                                            </h5>
                                            <form action="{{ route('review.storeFromTransaction', [$tx->id, $item->product->id]) }}" method="POST" class="space-y-3">
                                                @csrf
                                                <div>
                                                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Rating Produk (Bintang)</label>
                                                    <div class="flex items-center gap-1.5 star-rating" id="stars-{{ $tx->id }}-{{ $item->product->id }}">
                                                        <input type="hidden" name="rating" id="rating-input-{{ $tx->id }}-{{ $item->product->id }}" value="" required />
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <button type="button" onclick="selectStar({{ $tx->id }}, {{ $item->product->id }}, {{ $i }})" class="star-btn focus:outline-none">
                                                                <span class="material-symbols-outlined star-icon text-[24px] text-slate-300 hover:text-amber-400 transition-colors">star</span>
                                                            </button>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <div>
                                                    <label for="comment-{{ $tx->id }}-{{ $item->product->id }}" class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Komentar Ulasan</label>
                                                    <textarea id="comment-{{ $tx->id }}-{{ $item->product->id }}" name="comment" required rows="2" placeholder="Tulis komentar ulasan Anda mengenai produk ini..." class="w-full bg-white text-xs py-2 px-3 rounded-lg border border-slate-200 focus:ring-1 focus:ring-primary focus:outline-none transition-all"></textarea>
                                                </div>
                                                <div class="flex justify-end gap-2 text-xs">
                                                    <button type="button" onclick="toggleReviewForm({{ $tx->id }}, {{ $item->product->id }})" class="px-3 py-1.5 border border-slate-200 rounded-lg text-slate-600 font-semibold hover:bg-slate-100 transition-all">Batal</button>
                                                    <button type="submit" class="px-4 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-lg transition-all shadow-sm">Kirim Ulasan</button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Footer / Summary -->
                    <div class="p-md bg-surface-container-lowest border-t border-outline-variant flex flex-col md:flex-row md:items-center justify-between gap-md">
                        <div class="text-caption text-on-surface-variant space-y-1">
                            <p class="flex items-center gap-1.5 text-xs text-on-surface">
                                <span class="material-symbols-outlined text-[16px] text-primary">
                                    {{ $tx->delivery_option === 'pickup' ? 'store' : 'local_shipping' }}
                                </span>
                                <strong>Metode Penerimaan:</strong> 
                                <span>{{ $tx->delivery_option === 'pickup' ? 'Ambil di Toko Utama (YTM)' : 'Kirim ke Alamat via ' . (explode(' | ', $tx->notes)[1] ?? 'Kurir') }}</span>
                            </p>
                            @if($tx->delivery_option === 'shipping')
                                <p class="text-xs">
                                    <strong>Alamat Pengiriman:</strong> <span class="text-on-surface">{{ $tx->shipping_address }}</span>
                                </p>
                                <p class="text-xs flex items-center gap-1.5">
                                    <strong>No. Resi Pengiriman:</strong> 
                                    @if($tx->tracking_number)
                                        <span class="font-extrabold text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded border border-emerald-200 text-[10px]">
                                            {{ $tx->tracking_number }}
                                        </span>
                                    @else
                                        <span class="text-slate-400 italic text-[11px]">Belum diinput oleh admin</span>
                                    @endif
                                </p>
                            @endif
                        </div>
                        <div class="flex flex-col items-end gap-2">
                            <div class="text-right">
                                <span class="text-caption text-on-surface-variant block text-[11px]">Total Pembayaran</span>
                                <span class="text-lg font-extrabold text-primary">Rp {{ number_format($tx->total_price, 0, ',', '.') }}</span>
                            </div>
                            @if($tx->status === 'pending')
                                @if($tx->midtrans_payment_url)
                                    <a href="{{ $tx->midtrans_payment_url }}" target="_blank" class="px-4 py-2 bg-primary text-white font-bold text-xs rounded-xl hover:opacity-90 hover:scale-[1.02] active:scale-[0.98] transition-all shadow-sm flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-[16px]">payments</span>
                                        Bayar Sekarang
                                    </a>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs rounded-lg font-bold">
                                        <span class="material-symbols-outlined text-[14px]">payments</span>
                                        Bayar Cash di Kasir
                                    </span>
                                @endif
                            @elseif($tx->status === 'shipped' && $tx->delivery_option === 'shipping')
                                <form action="{{ route('transactions.confirm', $tx->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin melakukan konfirmasi barang sampai?');">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl hover:scale-[1.02] active:scale-[0.98] transition-all shadow-sm flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-[16px]">done_all</span>
                                        Konfirmasi Barang Sampai
                                    </button>
                                </form>
                            @elseif($tx->status === 'paid' && $tx->delivery_option === 'pickup')
                                <form action="{{ route('transactions.confirm', $tx->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin melakukan konfirmasi barang sudah diambil di toko?');">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl hover:scale-[1.02] active:scale-[0.98] transition-all shadow-sm flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-[16px]">storefront</span>
                                        Konfirmasi Sudah Diambil
                                    </button>
                                </form>
                            @endif
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

@push('script')
    <script>
        function toggleReviewForm(txId, productId) {
            const form = document.getElementById(`review-form-${txId}-${productId}`);
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
            } else {
                form.classList.add('hidden');
            }
        }

        function selectStar(txId, productId, ratingValue) {
            const starContainer = document.getElementById(`stars-${txId}-${productId}`);
            const stars = starContainer.querySelectorAll('.star-icon');
            stars.forEach((star, index) => {
                if (index < ratingValue) {
                    star.classList.add('text-amber-400');
                    star.classList.remove('text-slate-300');
                } else {
                    star.classList.add('text-slate-300');
                    star.classList.remove('text-amber-400');
                }
            });
            // set hidden input value
            document.getElementById(`rating-input-${txId}-${productId}`).value = ratingValue;
        }
    </script>
@endpush
