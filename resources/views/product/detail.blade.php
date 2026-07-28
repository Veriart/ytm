@extends('layout')

@section('content')
    <main class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin-desktop py-md">
        <!-- Alerts -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6 flex justify-between items-center text-sm font-semibold shadow-sm">
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6 flex justify-between items-center text-sm font-semibold shadow-sm">
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Product Hero Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
            <!-- Left: Imagery & Gallery -->
            <div class="lg:col-span-7 space-y-sm">
                <div
                    class="bento-card bg-surface-container-lowest rounded-xl overflow-hidden aspect-[4/3] flex items-center justify-center border border-outline-variant">
                    @if(Str::startsWith($product->image, 'http'))
                        <img class="w-full h-full object-cover" src="{{ $product->image }}" alt="{{ $product->name }}" />
                    @else
                        <img class="w-full h-full object-cover" src="{{ asset($product->image) }}" alt="{{ $product->name }}" />
                    @endif
                </div>
            </div>
            <!-- Right: Buy Box & Core Info -->
            <div class="lg:col-span-5 space-y-gutter">
                <div class="bg-surface-container-lowest rounded-xl p-md border border-outline-variant shadow-sm space-y-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-primary font-label-md text-label-md tracking-wider">KATEGORI: {{ strtoupper($product->category->name) }}</span>
                    </div>
                    <h1 class="font-headline-lg text-headline-lg text-on-surface">{{ $product->name }}</h1>
                    <div class="flex items-baseline gap-xs">
                        <span class="text-on-surface font-headline-md text-headline-md">Rp {{ number_format($product->price, 0, ',', '.') }},-</span>
                    </div>
                    <div class="flex items-center gap-xs">
                        <div class="flex text-secondary">
                            <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">star</span>
                        </div>
                        <span class="text-outline text-label-md font-label-md">{{ number_format($product->rating, 1) }} ({{ $product->sold_count }}+ Terjual)</span>
                    </div>
                    
                    <div class="py-2">
                        <p class="text-body-md text-on-surface-variant leading-relaxed">{{ $product->description }}</p>
                    </div>

                    <hr class="border-outline-variant" />
                    
                    <div class="pt-2">
                        <p class="text-caption text-on-surface-variant mb-2">Tersedia Stok: <span class="font-bold text-primary">{{ $product->stock }} pcs</span></p>
                        
                        <form action="{{ route('cart.add') }}" method="POST" class="flex gap-sm w-full">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}" />
                            <div class="w-32 flex items-center border border-outline-variant rounded-lg overflow-hidden h-12">
                                <button type="button" class="flex-1 h-full hover:bg-surface-container transition-colors qty-min">-</button>
                                <input type="number" name="quantity" class="w-10 text-center font-label-md qty-val border-none focus:ring-0 p-0 bg-transparent" value="1" min="1" max="{{ $product->stock }}" readonly />
                                <button type="button" class="flex-1 h-full hover:bg-surface-container transition-colors qty-plus">+</button>
                            </div>
                            <button type="submit"
                                class="flex-1 bg-secondary-container text-on-secondary-container rounded-lg font-label-md text-label-md h-12 flex items-center justify-center gap-xs hover:opacity-90 active:scale-95 transition-all">
                                <span class="material-symbols-outlined">shopping_bag</span>
                                Tambah ke Keranjang
                            </button>
                        </form>
                    </div>
                    <div class="flex items-center gap-sm pt-xs">
                        <div class="flex items-center gap-1 text-on-tertiary-fixed-variant text-caption">
                            <span class="material-symbols-outlined text-[16px]">local_shipping</span>
                            Free Cold-Chain Delivery
                        </div>
                        <div class="flex items-center gap-1 text-on-tertiary-fixed-variant text-caption">
                            <span class="material-symbols-outlined text-[16px]">verified</span>
                            Authenticity Guaranteed
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Details Bento Section -->
        <div class="mt-lg">
            <!-- Features: Dosage -->
            <div
                class="bento-card md:col-span-2 bg-surface-container-lowest p-md rounded-xl border border-outline-variant space-y-md">
                <div class="flex items-center gap-xs">
                    <span class="material-symbols-outlined text-primary">medical_information</span>
                    <h2 class="font-headline-md text-headline-md">Panduan Medis &amp; Dosis Penggunaan</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-md">
                    <div class="space-y-xs">
                        <h4 class="font-label-md text-label-md text-primary">Aturan Pakai &amp; Administrasi</h4>
                        <p class="text-body-md text-on-surface-variant leading-relaxed">
                            {{ $product->dosage_guidelines ?? 'Ikuti petunjuk dari dokter hewan berlisensi atau petunjuk tertulis pada label kemasan produk.' }}
                        </p>
                    </div>
                    <div class="space-y-xs">
                        <h4 class="font-label-md text-label-md text-primary">Indikasi Hewan</h4>
                        <p class="text-body-md text-on-surface-variant leading-relaxed">
                            {{ $product->indication ?? 'Diformulasikan khusus untuk menjaga kesehatan, kekebalan, dan menangani patogen target pada spesies hewan terkait.' }}
                        </p>
                    </div>
                </div>
                <div class="p-sm bg-surface rounded-lg border-l-4 border-primary">
                    <p class="font-label-md text-label-md mb-1">Catatan Apoteker / Dokter Hewan:</p>
                    <p class="text-body-md text-on-surface-variant">{{ $product->pharmacist_note ?? 'Simpan pada suhu ruang terkendali (15° - 30°C). Jauhkan dari sinar matahari langsung.' }}</p>
                </div>
            </div>
        </div>
        <!-- Trust Signals / Certification Section -->
        <div class="mt-lg flex flex-wrap justify-center gap-lg py-md border-y border-outline-variant">
            <div class="flex items-center gap-sm opacity-60 hover:opacity-100 transition-opacity">
                <span class="material-symbols-outlined text-3xl">verified</span>
                <div>
                    <p class="font-black text-body-md uppercase tracking-tighter">FDA Approved</p>
                    <p class="text-caption">Safe &amp; Regulated</p>
                </div>
            </div>
            <div class="flex items-center gap-sm opacity-60 hover:opacity-100 transition-opacity">
                <span class="material-symbols-outlined text-3xl">local_pharmacy</span>
                <div>
                    <p class="font-black text-body-md uppercase tracking-tighter">Certified GPP</p>
                    <p class="text-caption">Pharmacy Practices</p>
                </div>
            </div>
            <div class="flex items-center gap-sm opacity-60 hover:opacity-100 transition-opacity">
                <span class="material-symbols-outlined text-3xl">support_agent</span>
                <div>
                    <p class="font-black text-body-md uppercase tracking-tighter">Vet Support</p>
                    <p class="text-caption">24/7 Hotline</p>
                </div>
            </div>
            <div class="flex items-center gap-sm opacity-60 hover:opacity-100 transition-opacity">
                <span class="material-symbols-outlined text-3xl">lock</span>
                <div>
                    <p class="font-black text-body-md uppercase tracking-tighter">Secure Rx</p>
                    <p class="text-caption">HIPAA Compliant</p>
                </div>
            </div>
        </div>

        <!-- Product Reviews Section -->
        <div class="mt-lg grid grid-cols-1 lg:grid-cols-12 gap-gutter border-t border-outline-variant pt-lg">
            <!-- Review Stats & Form -->
            <div class="lg:col-span-4 space-y-md">
                <div class="bg-surface-container-lowest p-md rounded-xl border border-outline-variant space-y-sm shadow-sm">
                    <h3 class="font-headline-md text-headline-md">Ulasan &amp; Rating</h3>
                    <div class="flex items-center gap-sm">
                        <h4 class="text-4xl font-extrabold text-primary">{{ number_format($product->rating, 1) }}</h4>
                        <div>
                            <div class="flex text-secondary">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' {{ $i <= round($product->rating) ? 1 : 0 }};">star</span>
                                @endfor
                            </div>
                            <p class="text-caption text-on-surface-variant">{{ $product->reviews()->count() }} ulasan dari pembeli</p>
                        </div>
                    </div>
                </div>

                @if(Auth::check())
                    <!-- Write Review Form -->
                    <div class="bg-surface-container-lowest p-md rounded-xl border border-outline-variant space-y-sm shadow-sm">
                        <h4 class="font-label-md text-label-md text-primary">Tulis Ulasan Anda</h4>
                        <form action="{{ route('review.store', $product->id) }}" method="POST" class="space-y-3">
                            @csrf
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Rating Bintang</label>
                                <select name="rating" required class="w-full bg-surface-container-low text-body-md py-1.5 px-3 rounded-lg border border-outline-variant focus:border-primary outline-none">
                                    <option value="5" selected>★★★★★ (5 - Sangat Puas)</option>
                                    <option value="4">★★★★☆ (4 - Puas)</option>
                                    <option value="3">★★★☆☆ (3 - Cukup)</option>
                                    <option value="2">★★☆☆☆ (2 - Kurang)</option>
                                    <option value="1">★☆☆☆☆ (1 - Kecewa)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Komentar / Catatan</label>
                                <textarea name="comment" rows="3" required placeholder="Tuliskan pengalaman Anda menggunakan obat/produk hewan ini..." class="w-full bg-surface-container-low text-body-md py-2 px-3 rounded-lg border border-outline-variant focus:border-primary outline-none"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg font-label-md text-label-md hover:opacity-95 active:scale-95 transition-all">
                                Kirim Ulasan
                            </button>
                        </form>
                    </div>
                @else
                    <div class="p-sm bg-surface-container-low rounded-lg text-center text-caption">
                        Silakan <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">login</a> untuk menulis ulasan produk.
                    </div>
                @endif
            </div>

            <!-- Reviews List -->
            <div class="lg:col-span-8 space-y-sm">
                <div class="bg-surface-container-lowest p-md rounded-xl border border-outline-variant space-y-md shadow-sm">
                    <h3 class="font-headline-md text-headline-md border-b pb-2">Ulasan Pelanggan</h3>
                    <div class="space-y-sm max-h-[500px] overflow-y-auto pr-2">
                        @forelse($product->reviews()->latest()->get() as $rev)
                            <div class="border-b border-surface-container pb-sm last:border-0 last:pb-0">
                                <div class="flex justify-between items-start mb-1">
                                    <div>
                                        <span class="font-semibold text-body-md block">{{ $rev->user->name }}</span>
                                        <div class="flex text-secondary">
                                            @for($i = 1; $i <= 5; $i++)
                                                <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' {{ $i <= $rev->rating ? 1 : 0 }};">star</span>
                                            @endfor
                                        </div>
                                    </div>
                                    <span class="text-caption text-on-surface-variant">{{ $rev->created_at->format('d M Y') }}</span>
                                </div>
                                <p class="text-body-md text-on-surface-variant mt-1">{{ $rev->comment }}</p>
                            </div>
                        @empty
                            <p class="text-center text-muted py-6">Belum ada ulasan untuk produk ini.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const qtyVal = document.querySelector('.qty-val');
            const qtyPlus = document.querySelector('.qty-plus');
            const qtyMin = document.querySelector('.qty-min');
            const maxVal = parseInt(qtyVal.getAttribute('max')) || 999;

            qtyPlus.addEventListener('click', () => {
                const current = parseInt(qtyVal.value) || 1;
                if (current < maxVal) {
                    qtyVal.value = current + 1;
                }
            });

            qtyMin.addEventListener('click', () => {
                const current = parseInt(qtyVal.value) || 1;
                if (current > 1) {
                    qtyVal.value = current - 1;
                }
            });
        });
    </script>
@endpush
