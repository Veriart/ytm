@extends('layout')

@section('content')
    <main class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin-desktop py-8 space-y-8">

        <!-- Product Hero Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left: Imagery & Gallery (Col Span 7) -->
            <div class="lg:col-span-7">
                <div
                    class="bg-white rounded-2xl overflow-hidden aspect-[4/3] flex items-center justify-center border border-outline-variant shadow-sm">
                    @if (Str::startsWith($product->image, 'http'))
                        <img class="w-full h-full object-cover" src="{{ $product->image }}" alt="{{ $product->name }}" />
                    @else
                        <img class="w-full h-full object-cover" src="{{ asset($product->image) }}"
                            alt="{{ $product->name }}" />
                    @endif
                </div>
            </div>

            <!-- Right: Buy Box & Core Info (Col Span 5) -->
            <div class="lg:col-span-5 flex flex-col justify-between">
                <div class="bg-white rounded-2xl p-6 border border-outline-variant shadow-sm space-y-4">
                    <!-- Category & Brand -->
                    <div
                        class="flex justify-between items-center text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <span>Kategori: {{ $product->category->name }}</span>
                        <span>Merek: {{ $product->brand ?? '-' }}</span>
                    </div>

                    <!-- Product Name -->
                    <h1 class="text-2xl font-extrabold text-slate-800 leading-tight flex items-center gap-2">
                        {{ $product->name }}
                        @if ($product->needs_prescription)
                            <span
                                class="inline-flex items-center text-[10px] font-extrabold bg-rose-50 text-rose-600 px-2 py-0.5 rounded border border-rose-100"
                                title="Wajib Resep Dokter Hewan">
                                R/
                            </span>
                        @endif
                    </h1>

                    <!-- Rating & Reviews -->
                    <div class="flex items-center gap-2">
                        <div class="flex text-secondary">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="material-symbols-outlined text-[16px]"
                                    style="font-variation-settings: 'FILL' {{ $i <= round($product->rating) ? 1 : 0 }};">star</span>
                            @endfor
                        </div>
                        <span class="text-slate-400 text-xs font-semibold">{{ number_format($product->rating, 1) }} &bull;
                            {{ $product->reviews()->count() }} ulasan</span>
                    </div>

                    <!-- Price -->
                    <div class="pt-2 border-t border-slate-50">
                        <p class="text-3xl font-extrabold text-primary">Rp
                            {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>

                    <!-- Mini Info -->
                    <div
                        class="text-xs text-slate-500 leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-100 space-y-1">
                        <p><strong>Spesies Target:</strong> {{ $product->target_animals ?? 'Semua Hewan / Umum' }}</p>
                        <p><strong>Bentuk Sediaan:</strong> {{ $product->dosage_form ?? '-' }}</p>
                        <p><strong>No. Izin Edar:</strong> {{ $product->registration_number ?? '-' }}</p>
                        <p><strong>No. Batch:</strong> {{ $product->batch_number ?? '-' }}</p>
                    </div>

                    <hr class="border-slate-100" />

                    <!-- Buy Box Controls -->
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-xs font-semibold">
                            <span class="text-slate-500">Ketersediaan Stok</span>
                            @if ($product->stock <= 0)
                                <span class="text-rose-600 font-bold">Stok Habis</span>
                            @elseif($product->stock <= 5)
                                <span class="text-amber-600 font-bold">Terbatas ({{ $product->stock }} unit)</span>
                            @else
                                <span class="text-emerald-600 font-bold">Tersedia ({{ $product->stock }} unit)</span>
                            @endif
                        </div>

                        <form action="{{ route('cart.add') }}" method="POST"
                            class="flex flex-col sm:flex-row gap-3 w-full">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}" />

                            <!-- Quantity counter -->
                            <div
                                class="flex items-center border border-slate-200 rounded-xl overflow-hidden h-12 bg-slate-50/50 justify-between px-2 w-full sm:w-32">
                                <button type="button"
                                    class="w-8 h-8 rounded-lg hover:bg-slate-100 font-extrabold flex items-center justify-center text-slate-600 transition-colors qty-min">-</button>
                                <input type="number" name="quantity"
                                    class="w-10 text-center font-bold text-sm qty-val border-none focus:ring-0 p-0 bg-transparent text-slate-800"
                                    value="1" min="1" max="{{ $product->stock }}" readonly />
                                <button type="button"
                                    class="w-8 h-8 rounded-lg hover:bg-slate-100 font-extrabold flex items-center justify-center text-slate-600 transition-colors qty-plus"
                                    {{ $product->stock <= 1 ? 'disabled' : '' }}>+</button>
                            </div>

                            <!-- Buy Button -->
                            @if ($product->stock > 0)
                                @php
                                    $disabled = '';
                                    if (Auth::check()) {
                                        if (Auth::user()->role == 'admin') {
                                            $disabled = 'disabled';
                                        }
                                    }
                                @endphp
                                <button type="submit" {{ $disabled }}
                                    class="flex-1 bg-primary text-white rounded-xl font-bold text-sm h-12 flex items-center justify-center gap-2 hover:bg-primary/95 active:scale-98 transition-all shadow-md">
                                    <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                                    Tambah ke Keranjang
                                </button>
                            @else
                                <button type="button" disabled
                                    class="flex-1 bg-slate-100 text-slate-400 rounded-xl font-bold text-sm h-12 flex items-center justify-center gap-2 cursor-not-allowed">
                                    <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                                    Stok Habis
                                </button>
                            @endif
                        </form>
                    </div>

                    <div
                        class="flex items-center gap-4 text-[10px] text-slate-400 font-semibold pt-1 border-t border-slate-50">
                        <div class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">local_shipping</span>
                            Cold-Chain Safety Delivery
                        </div>
                        <div class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">verified</span>
                            Jaminan Original 100%
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Tabs Section (Polished Layout) -->
        <div class="bg-white rounded-2xl border border-outline-variant shadow-sm overflow-hidden mt-8">
            <!-- Tabs Headers -->
            <div class="border-b border-slate-100 dark:border-slate-700 bg-slate-50/50">
                <nav class="flex space-x-6 px-6" aria-label="Tabs">
                    <button type="button"
                        class="desc-tab-link border-emerald-500 text-emerald-600 px-1 py-4 border-b-2 font-bold text-sm select-none cursor-pointer focus:outline-none transition-colors"
                        data-target="#tab-deskripsi">
                        Deskripsi
                    </button>
                    <button type="button"
                        class="desc-tab-link border-transparent text-slate-400 hover:text-slate-600 px-1 py-4 border-b-2 font-semibold text-sm select-none cursor-pointer focus:outline-none transition-colors"
                        data-target="#tab-komposisi">
                        Kandungan &amp; Komposisi
                    </button>
                    <button type="button"
                        class="desc-tab-link border-transparent text-slate-400 hover:text-slate-600 px-1 py-4 border-b-2 font-semibold text-sm select-none cursor-pointer focus:outline-none transition-colors"
                        data-target="#tab-aturan">
                        Indikasi &amp; Aturan Pakai
                    </button>
                    <button type="button"
                        class="desc-tab-link border-transparent text-slate-400 hover:text-slate-600 px-1 py-4 border-b-2 font-semibold text-sm select-none cursor-pointer focus:outline-none transition-colors"
                        data-target="#tab-dosis-hewan">
                        Dosis per Jenis Hewan
                    </button>
                </nav>
            </div>

            <!-- Tabs Content Panes -->
            <div class="p-6 text-sm text-slate-600 dark:text-slate-300 leading-relaxed min-h-[160px]">
                <!-- Deskripsi Pane -->
                <div id="tab-deskripsi" class="desc-tab-pane space-y-3">
                    <h4 class="font-bold text-slate-800 dark:text-white text-base">Deskripsi Produk</h4>
                    <p>{{ $product->description }}</p>
                </div>

                <!-- Kandungan & Komposisi Pane -->
                <div id="tab-komposisi" class="desc-tab-pane space-y-3 hidden">
                    <h4 class="font-bold text-slate-800 dark:text-white text-base">Bahan Aktif &amp; Komposisi Medis</h4>
                    @if ($product->active_ingredients)
                        <p class="bg-slate-50 p-4 rounded-xl border border-slate-100 font-mono text-xs text-slate-700">
                            {{ $product->active_ingredients }}
                        </p>
                    @else
                        <p class="text-slate-400 italic">Informasi kandungan bahan aktif tidak didetailkan secara spesifik.
                        </p>
                    @endif
                </div>

                <!-- Indikasi & Aturan Pakai Pane -->
                <div id="tab-aturan" class="desc-tab-pane space-y-3 hidden">
                    <h4 class="font-bold text-slate-800 dark:text-white text-base">Indikasi Medis &amp; Cara Pemberian</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1.5">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Indikasi
                                Medis</span>
                            <p class="text-slate-600 bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                                {{ $product->indication ?? 'Diformulasikan untuk spesies target.' }}</p>
                        </div>
                        <div class="space-y-1.5">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block">Aturan Pakai &amp;
                                Administrasi</span>
                            <p class="text-slate-600 bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                                {{ $product->dosage_guidelines ?? 'Gunakan sesuai dosis label kemasan.' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Dosis per Jenis Hewan Pane -->
                <div id="tab-dosis-hewan" class="desc-tab-pane space-y-3 hidden">
                    <h4 class="font-bold text-slate-800 dark:text-white text-base">Catatan Penyaluran &amp; Dosis Spesies
                    </h4>
                    <p class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-slate-700">
                        {{ $product->pharmacist_note ?? 'Simpan di bawah suhu 30°C. Lindungi dari kelembaban.' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Trust Signals / Certification Section -->
        <div class="flex flex-wrap justify-center gap-12 py-6 border-y border-slate-100 text-slate-500">
            <div class="flex items-center gap-3 opacity-70 hover:opacity-100 transition-opacity">
                <span class="material-symbols-outlined text-3xl">verified</span>
                <div>
                    <p class="font-extrabold text-sm uppercase tracking-wider text-slate-800">ASOHI MEMBER</p>
                    <p class="text-xs">Terdaftar Resmi</p>
                </div>
            </div>
            <div class="flex items-center gap-3 opacity-70 hover:opacity-100 transition-opacity">
                <span class="material-symbols-outlined text-3xl">local_pharmacy</span>
                <div>
                    <p class="font-extrabold text-sm uppercase tracking-wider text-slate-800">Sertifikasi GPP</p>
                    <p class="text-xs">Good Pharmacy Practice</p>
                </div>
            </div>
            <div class="flex items-center gap-3 opacity-70 hover:opacity-100 transition-opacity">
                <span class="material-symbols-outlined text-3xl">support_agent</span>
                <div>
                    <p class="font-extrabold text-sm uppercase tracking-wider text-slate-800">Vet Support</p>
                    <p class="text-xs">Hotline Apoteker</p>
                </div>
            </div>
        </div>

        <!-- Reviews List Section -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 border-t border-slate-100 pt-8">
            <!-- Review Stats & Form (Col Span 4) -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white p-6 rounded-2xl border border-outline-variant shadow-sm space-y-4">
                    <h3 class="text-lg font-bold text-slate-900">Ulasan &amp; Rating</h3>
                    <div class="flex items-center gap-4">
                        <h4 class="text-5xl font-black text-primary">{{ number_format($product->rating, 1) }}</h4>
                        <div>
                            <div class="flex text-secondary">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="material-symbols-outlined text-[20px]"
                                        style="font-variation-settings: 'FILL' {{ $i <= round($product->rating) ? 1 : 0 }};">star</span>
                                @endfor
                            </div>
                            <p class="text-xs text-slate-400 mt-1">{{ $product->reviews()->count() }} ulasan dari
                                pelanggan</p>
                        </div>
                    </div>
                </div>

                @if (Auth::check())
                    <!-- Write Review Form -->
                    <div class="bg-white p-6 rounded-2xl border border-outline-variant shadow-sm space-y-4">
                        <h4 class="font-bold text-sm text-slate-800">Tulis Ulasan Anda</h4>
                        <form action="{{ route('review.store', $product->id) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Rating
                                    Bintang</label>
                                <select name="rating" required
                                    class="w-full bg-slate-50 text-sm py-2.5 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent outline-none">
                                    <option value="5" selected>★★★★★ (5 - Sangat Puas)</option>
                                    <option value="4">★★★★☆ (4 - Puas)</option>
                                    <option value="3">★★★☆☆ (3 - Cukup)</option>
                                    <option value="2">★★☆☆☆ (2 - Kurang)</option>
                                    <option value="1">★☆☆☆☆ (1 - Kecewa)</option>
                                </select>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Komentar
                                    Ulasan</label>
                                <textarea name="comment" rows="3" required placeholder="Tuliskan pengalaman Anda menggunakan obat hewan ini..."
                                    class="w-full bg-slate-50 text-sm py-2.5 px-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent outline-none"></textarea>
                            </div>
                            <button type="submit"
                                class="w-full bg-primary text-white py-2.5 rounded-xl font-bold text-xs hover:bg-primary/95 active:scale-98 transition-all shadow-sm">
                                Kirim Ulasan
                            </button>
                        </form>
                    </div>
                @else
                    <div class="p-4 bg-slate-50 border rounded-xl text-center text-xs text-slate-500">
                        Silakan <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">login</a>
                        untuk menulis ulasan produk.
                    </div>
                @endif
            </div>

            <!-- Reviews List (Col Span 8) -->
            <div class="lg:col-span-8">
                <div class="bg-white p-6 rounded-2xl border border-outline-variant shadow-sm space-y-6">
                    <h3 class="text-base font-bold text-slate-900 border-b border-slate-50 pb-3">Daftar Testimoni</h3>
                    <div class="space-y-4 max-h-[500px] overflow-y-auto pr-2">
                        @forelse($product->reviews()->latest()->get() as $rev)
                            <div class="border-b border-slate-100 pb-4 last:border-0 last:pb-0">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <span class="font-bold text-sm text-slate-800 block">{{ $rev->user->name }}</span>
                                        <div class="flex text-secondary mt-0.5">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span class="material-symbols-outlined text-[14px]"
                                                    style="font-variation-settings: 'FILL' {{ $i <= $rev->rating ? 1 : 0 }};">star</span>
                                            @endfor
                                        </div>
                                    </div>
                                    <span class="text-xs text-slate-400">{{ $rev->created_at->format('d M Y') }}</span>
                                </div>
                                <p class="text-sm text-slate-500 mt-2">{{ $rev->comment }}</p>
                            </div>
                        @empty
                            <p class="text-center text-slate-400 py-12 text-sm italic">Belum ada ulasan untuk produk obat
                                ini.</p>
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
            // Quantity Increment and Decrement Logic (with stock validation)
            const qtyVal = document.querySelector('.qty-val');
            const qtyPlus = document.querySelector('.qty-plus');
            const qtyMin = document.querySelector('.qty-min');
            const maxVal = parseInt(qtyVal.getAttribute('max')) || 0;

            if (qtyPlus && qtyMin && qtyVal) {
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
            }

            // Description Details Tab Swapper Logic
            const tabLinks = document.querySelectorAll('.desc-tab-link');
            const tabPanes = document.querySelectorAll('.desc-tab-pane');

            tabLinks.forEach(link => {
                link.addEventListener('click', function() {
                    // Reset active states
                    tabLinks.forEach(item => {
                        item.classList.remove('border-emerald-500', 'text-emerald-600',
                            'font-bold');
                        item.classList.add('border-transparent', 'text-slate-400',
                            'font-semibold');
                    });

                    // Set current active
                    this.classList.remove('border-transparent', 'text-slate-400', 'font-semibold');
                    this.classList.add('border-emerald-500', 'text-emerald-600', 'font-bold');

                    // Hide all panes
                    tabPanes.forEach(pane => pane.classList.add('hidden'));

                    // Show current pane
                    const target = this.getAttribute('data-target');
                    document.querySelector(target).classList.remove('hidden');
                });
            });
        });
    </script>
@endpush
