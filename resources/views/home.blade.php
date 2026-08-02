@extends('layout')

@section('content')
    <main class="w-full max-w-[1280px] mx-auto px-margin-mobile md:px-margin-desktop py-md space-y-6">
        <!-- Hero Section: Carousel/Banner -->
        <section
            class="mb-6 overflow-hidden rounded-2xl shadow-sm group relative aspect-[21/9] md:aspect-[3/1] bg-surface-container-highest"
            id="home-carousel">
            <!-- Slides Container -->
            <div class="relative w-full h-full overflow-hidden">
                <!-- Slide 1 -->
                <div class="carousel-slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-100 z-10"
                    data-index="0">
                    <div class="absolute inset-0 bg-cover bg-center"
                        style="background-image: url('{{ \App\Models\Setting::getValue('banner_image_1', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBUPmxzypNMHfMiYkCk7Yr3kM65t-hMJ0O092cof5zHs0u_3B85M93vvm2RS5ILaCiGFm4QYg_tERKUFK2gDDlkLdZyktGbIAWYY2-ZHlvFpZoerJ8wdppF-Jc-92jB7_Z0MEYqvv3Dv2dxZ1OHJ8CkFxCMcaKw1yztrVQKFSNmg-Bs0h_qr_0dTzOzPLaWdBbYYPmTEJZGpn5FjJFm4105slvqkpzKeD11BiIeed7wKtMg6cEbGIl9Fg') }}')">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-transparent flex items-center px-10">
                        <div class="max-w-md text-white">
                            <h2 class="font-headline-lg text-headline-lg mb-4 drop-shadow-md">
                                {{ \App\Models\Setting::getValue('banner_title_1', 'Solusi Kesehatan Hewan Terpercaya') }}
                            </h2>
                            <p class="font-body-md text-body-md mb-6 opacity-90">
                                {{ \App\Models\Setting::getValue('banner_subtitle_1', 'Distributor resmi obat-obatan.') }}
                            </p>
                            <a href="{{ \App\Models\Setting::getValue('banner_link_1', '/') }}"
                                class="inline-block bg-secondary px-8 py-3 rounded-full font-label-md text-label-md text-white hover:bg-secondary/95 transition-all active:scale-95 shadow-md">
                                Cek Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-0 z-0"
                    data-index="1">
                    <div class="absolute inset-0 bg-cover bg-center"
                        style="background-image: url('{{ \App\Models\Setting::getValue('banner_image_2', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDNxN7bLDYs8Ntog2UEH9rEQ3MqMQsWH05Nlpd8cyoxY4qqWd51rfLp6xNZKG_-fbR-d-8lDLlF1wxSF7AGb-OKlGoHDpxL-_BiUB8PsacJlwFD74W0LEMD7mkiCiM66QErUnJGAXRc8tgjPK-K7BL-yHWb6gHoPDRutAkq6fj2gRdWvaQCNTgO8whNvBGfjiTVzRNyHo51zitvWaxQWVdlcOW6MxzWJP3pax2TzhjhGGDyL_4VgOiJOg') }}')">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-transparent flex items-center px-10">
                        <div class="max-w-md text-white">
                            <h2 class="font-headline-lg text-headline-lg mb-4 drop-shadow-md">
                                {{ \App\Models\Setting::getValue('banner_title_2', 'Grosir Peralatan Medis Hewan') }}</h2>
                            <p class="font-body-md text-body-md mb-6 opacity-90">
                                {{ \App\Models\Setting::getValue('banner_subtitle_2', 'Dapatkan penawaran harga khusus.') }}
                            </p>
                            <a href="{{ \App\Models\Setting::getValue('banner_link_2', '/') }}"
                                class="inline-block bg-secondary px-8 py-3 rounded-full font-label-md text-label-md text-white hover:bg-secondary/95 transition-all active:scale-95 shadow-md">
                                Cek Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-0 z-0"
                    data-index="2">
                    <div class="absolute inset-0 bg-cover bg-center"
                        style="background-image: url('{{ \App\Models\Setting::getValue('banner_image_3', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAsco9lh2Q-joVp6ZTwjlxnzoeZpSMUw6vSbmQaga5WcntUTjOjDTf_Z1UszVdBkHZT-pOPZemlyOeoBeVo35Y7uXesVXGZx-9HEOOkHhPcrQB2vtIazFadN06zCbm7-vAIpKX7SRno6SfeV09dE-XxUus_9SMDpx8rTHU7aptiIMDh2bRYlyUwrqnZPQjOm8XikCEclkwYTow0duoQ6cUOND1JClnNl9-u4dP2fsvSdh-g4ExJqWuzHQ') }}')">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-transparent flex items-center px-10">
                        <div class="max-w-md text-white">
                            <h2 class="font-headline-lg text-headline-lg mb-4 drop-shadow-md">
                                {{ \App\Models\Setting::getValue('banner_title_3', 'Suplemen & Nutrisi Hewan Premium') }}
                            </h2>
                            <p class="font-body-md text-body-md mb-6 opacity-90">
                                {{ \App\Models\Setting::getValue('banner_subtitle_3', 'Tingkatkan daya tahan ternak.') }}
                            </p>
                            <a href="{{ \App\Models\Setting::getValue('banner_link_3', '/') }}"
                                class="inline-block bg-secondary px-8 py-3 rounded-full font-label-md text-label-md text-white hover:bg-secondary/95 transition-all active:scale-95 shadow-md">
                                Cek Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination Indicators -->
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-20">
                <button class="carousel-dot w-2.5 h-2.5 rounded-full bg-white shadow-sm transition-all"
                    data-index="0"></button>
                <button
                    class="carousel-dot w-2.5 h-2.5 rounded-full bg-white/40 border border-white/20 shadow-sm transition-all"
                    data-index="1"></button>
                <button
                    class="carousel-dot w-2.5 h-2.5 rounded-full bg-white/40 border border-white/20 shadow-sm transition-all"
                    data-index="2"></button>
            </div>
        </section>

        <!-- Mobile Search Bar (Visible only on mobile screen widths) -->
        <section class="block md:hidden">
            <form action="{{ route('home') }}" method="GET" class="relative">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}" />
                @endif
                @if (request('target'))
                    <input type="hidden" name="target" value="{{ request('target') }}" />
                @endif
                <div class="relative w-full">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari obat hewan, merek, bahan..."
                        class="w-full bg-white border border-outline-variant/60 text-slate-800 text-sm pl-10 pr-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all shadow-sm" />
                    <span class="material-symbols-outlined absolute left-3 top-3 text-slate-400 text-lg">search</span>
                </div>
            </form>
        </section>

        <!-- Search Query Active Banner / Filter Indicator -->
        @if (request('search'))
            <section
                class="flex items-center justify-between p-4 bg-emerald-50 dark:bg-emerald-950/20 text-emerald-800 dark:text-emerald-300 rounded-xl border border-emerald-100 dark:border-emerald-900/50 text-xs font-semibold">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">search</span>
                    <span>Menampilkan hasil pencarian untuk: <strong
                            class="underline">"{{ request('search') }}"</strong></span>
                </div>
                <a href="{{ route('home', request()->except('search')) }}"
                    class="p-1 rounded-lg hover:bg-emerald-100 dark:hover:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400"
                    title="Hapus Pencarian">
                    <span class="material-symbols-outlined text-[16px]">close</span>
                </a>
            </section>
        @endif

        <!-- Category Tabs Menu -->
        <section class="border-b border-outline-variant flex items-end gap-md overflow-x-auto hide-scrollbar">
            <a href="{{ route('home', array_merge(request()->query(), ['category' => 'all'])) }}"
                class="pb-3 px-2 {{ $selectedCategory == 'all' ? 'border-b-4 border-primary text-primary' : 'text-on-surface-variant hover:text-primary' }} font-label-md text-label-md whitespace-nowrap transition-all">For
                You</a>
            @foreach ($categories as $cat)
                <a href="{{ route('home', array_merge(request()->query(), ['category' => $cat->slug])) }}"
                    class="pb-3 px-2 {{ $selectedCategory == $cat->slug ? 'border-b-4 border-primary text-primary' : 'text-on-surface-variant hover:text-primary' }} font-label-md text-label-md whitespace-nowrap transition-all">{{ $cat->name }}</a>
            @endforeach
        </section>

        <!-- Animal Species Quick Filters Bar -->
        {{-- <section class="flex flex-wrap items-center gap-2 py-1">
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider mr-2">Spesies Hewan:</span>
            <a href="{{ route('home', array_merge(request()->query(), ['target' => 'all'])) }}" class="px-3.5 py-1.5 rounded-full text-xs font-semibold border transition-all {{ $selectedTarget == 'all' ? 'bg-emerald-600 border-emerald-600 text-white shadow-sm' : 'bg-white border-slate-200 text-slate-700 hover:bg-slate-50' }}">
                Semua
            </a>
            @foreach (['Sapi', 'Kambing', 'Domba', 'Unggas', 'Anjing', 'Kucing'] as $animal)
                <a href="{{ route('home', array_merge(request()->query(), ['target' => $animal])) }}" class="px-3.5 py-1.5 rounded-full text-xs font-semibold border transition-all {{ $selectedTarget == $animal ? 'bg-emerald-600 border-emerald-600 text-white shadow-sm' : 'bg-white border-slate-200 text-slate-700 hover:bg-slate-50' }}">
                    {{ $animal }}
                </a>
            @endforeach
        </section> --}}

        <!-- Product Grid (Improved Spacing & Columns) -->
        <section class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($products as $prod)
                <div
                    class="bg-white rounded-2xl shadow-sm border border-outline-variant hover:shadow-md transition-all duration-300 group overflow-hidden flex flex-col justify-between h-full">
                    <!-- Product Details Anchor Link -->
                    <a href="{{ route('product.show', $prod->slug) }}" class="flex flex-col flex-1">
                        <!-- Product Photo & Status Badges -->
                        <div class="relative aspect-square bg-slate-50 border-b border-slate-100 overflow-hidden">
                            @if (Str::startsWith($prod->image, 'http'))
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    src="{{ $prod->image }}" alt="{{ $prod->name }}" />
                            @else
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    src="{{ asset($prod->image) }}" alt="{{ $prod->name }}" />
                            @endif

                            <!-- Stock Status Overlay Badge -->
                            <div class="absolute top-3 left-3 z-10">
                                @if ($prod->stock <= 0)
                                    <span
                                        class="inline-flex items-center text-[9px] font-bold bg-slate-900/80 text-white px-2 py-0.5 rounded shadow-sm">
                                        Habis
                                    </span>
                                @elseif($prod->stock <= 5)
                                    <span
                                        class="inline-flex items-center text-[9px] font-bold bg-rose-600/90 text-white px-2 py-0.5 rounded shadow-sm">
                                        Limit
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center text-[9px] font-bold bg-emerald-600/90 text-white px-2 py-0.5 rounded shadow-sm">
                                        Tersedia
                                    </span>
                                @endif
                            </div>

                            <!-- Target Animal Badge (Overlay top-right) -->
                            @if ($prod->target_animals)
                                <div class="absolute top-3 right-3 z-10 flex flex-col gap-1 items-end">
                                    @foreach (array_slice(explode(', ', $prod->target_animals), 0, 2) as $tag)
                                        <span
                                            class="inline-flex items-center text-[8px] font-bold bg-white/95 text-slate-800 px-1.5 py-0.5 rounded border border-slate-100 shadow-sm uppercase">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Product Texts -->
                        <div class="p-4 flex flex-col flex-1 space-y-2">
                            <!-- Category & Brand -->
                            <div
                                class="flex justify-between items-center text-[10px] text-slate-400 font-bold uppercase tracking-wider">
                                <span>{{ $prod->category->name }}</span>
                                <span class="max-w-[80px] truncate"
                                    title="{{ $prod->brand }}">{{ $prod->brand ?? '-' }}</span>
                            </div>

                            <!-- Name -->
                            <h3
                                class="font-bold text-slate-800 dark:text-slate-100 text-sm line-clamp-2 leading-snug group-hover:text-primary transition-colors flex-1">
                                {{ $prod->name }}
                            </h3>

                            <!-- Price & Rating Row (Kept at the bottom of texts area) -->
                            <div class="pt-2 border-t border-slate-50 mt-auto">
                                <p class="font-extrabold text-base text-primary">Rp
                                    {{ number_format($prod->price, 0, ',', '.') }}</p>

                                <div class="flex items-center gap-1 mt-1 text-[11px] text-slate-400">
                                    <span class="material-symbols-outlined text-secondary text-[13px]"
                                        style="font-variation-settings: 'FILL' 1;">star</span>
                                    <span
                                        class="font-semibold text-slate-600 dark:text-slate-300">{{ number_format($prod->rating, 1) }}</span>
                                    <span>&bull;</span>
                                    <span>{{ $prod->sold_count }}+ terjual</span>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Buy Box / Add to Cart Action -->
                    <div class="px-4 pb-4">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $prod->id }}" />
                            <input type="hidden" name="quantity" value="1" />

                            @if ($prod->stock > 0)
                                @php
                                    $disabled = '';
                                    if (Auth::check()) {
                                        if (Auth::user()->role == 'admin') {
                                            $disabled = 'disabled';
                                        }
                                    }
                                @endphp
                                <button type="submit" {{ $disabled }}
                                    class="w-full bg-secondary-container text-on-secondary-container hover:bg-emerald-600 hover:text-white rounded-xl py-2 font-bold text-xs flex items-center justify-center gap-1.5 transition-all shadow-sm active:scale-95">
                                    <span class="material-symbols-outlined text-[15px]">shopping_cart</span>
                                    + Keranjang
                                </button>
                            @else
                                <button type="button" disabled
                                    class="w-full bg-slate-100 text-slate-400 dark:bg-slate-800 dark:text-slate-600 rounded-xl py-2 font-bold text-xs flex items-center justify-center gap-1.5 cursor-not-allowed">
                                    <span class="material-symbols-outlined text-[15px]">shopping_cart</span>
                                    Stok Habis
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            @empty
                <div
                    class="col-span-full py-16 text-center text-slate-400 dark:text-slate-500 border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-2xl">
                    <i data-lucide="package-x" class="w-12 h-12 mx-auto text-slate-300 dark:text-slate-600 mb-3"></i>
                    <p class="font-bold text-sm text-slate-800 dark:text-white">Tidak ada produk obat hewan</p>
                    <p class="text-xs mt-1">Kami tidak dapat menemukan produk yang sesuai dengan kategori atau filter Anda.
                    </p>
                </div>
            @endforelse
        </section>

        <!-- Bento Grid Feature Section -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ \App\Models\Setting::getValue('banner_link', '/') }}"
                class="md:col-span-2 relative h-64 rounded-2xl overflow-hidden shadow-sm group">
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                    style="background-image: url('{{ \App\Models\Setting::getValue('banner_image', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDNxN7bLDYs8Ntog2UEH9rEQ3MqMQsWH05Nlpd8cyoxY4qqWd51rfLp6xNZKG_-fbR-d-8lDLlF1wxSF7AGb-OKlGoHDpxL-_BiUB8PsacJlwFD74W0LEMD7mkiCiM66QErUnJGAXRc8tgjPK-K7BL-yHWb6gHoPDRutAkq6fj2gRdWvaQCNTgO8whNvBGfjiTVzRNyHo51zitvWaxQWVdlcOW6MxzWJP3pax2TzhjhGGDyL_4VgOiJOg') }}')">
                </div>
                <div
                    class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/20 to-transparent p-8 flex flex-col justify-end">
                    <h2 class="font-headline-md text-headline-md text-white mb-2">
                        {{ \App\Models\Setting::getValue('banner_title', 'Grosir Peralatan Medis') }}</h2>
                    <p class="font-body-md text-white/90">
                        {{ \App\Models\Setting::getValue('banner_subtitle', 'Dapatkan harga khusus untuk pembelanjaan partai besar klinik dan instansi.') }}
                    </p>
                </div>
            </a>
            <div
                class="bg-primary-container rounded-2xl p-8 flex flex-col justify-center text-on-primary-container shadow-sm">
                <span class="material-symbols-outlined text-[48px] mb-4">local_pharmacy</span>
                <h3 class="font-headline-md text-headline-md mb-2">Konsultasi Apoteker</h3>
                <p class="font-body-md opacity-90 mb-6">Tanya jawab dosis dan interaksi obat dengan apoteker berlisensi
                    kami.</p>
                <button
                    class="w-full py-3 bg-white text-primary rounded-xl font-label-md text-label-md hover:bg-surface-container-low transition-all">Mulai
                    Chat</button>
            </div>
        </section>
    </main>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.carousel-slide');
            const dots = document.querySelectorAll('.carousel-dot');
            let currentSlide = 0;
            let slideInterval = setInterval(nextSlide, 5000);

            function showSlide(index) {
                if (!slides.length) return;
                slides.forEach((slide, idx) => {
                    if (idx === index) {
                        slide.classList.remove('opacity-0', 'z-0');
                        slide.classList.add('opacity-100', 'z-10');
                    } else {
                        slide.classList.remove('opacity-100', 'z-10');
                        slide.classList.add('opacity-0', 'z-0');
                    }
                });

                dots.forEach((dot, idx) => {
                    if (idx === index) {
                        dot.classList.remove('bg-white/40', 'border', 'border-white/20');
                        dot.classList.add('bg-white');
                    } else {
                        dot.classList.remove('bg-white');
                        dot.classList.add('bg-white/40', 'border', 'border-white/20');
                    }
                });
                currentSlide = index;
            }

            function nextSlide() {
                let next = (currentSlide + 1) % slides.length;
                showSlide(next);
            }

            dots.forEach((dot, idx) => {
                dot.addEventListener('click', () => {
                    clearInterval(slideInterval);
                    showSlide(idx);
                    slideInterval = setInterval(nextSlide, 5000);
                });
            });
        });
    </script>
@endpush
