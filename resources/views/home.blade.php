@extends('layout')
@section('content')
    <main class="w-full max-w-[1280px] mx-auto px-margin-mobile md:px-margin-desktop py-md">
        <!-- Hero Section: Carousel/Banner -->
        <section class="mb-lg overflow-hidden rounded-xl shadow-lg group relative aspect-[21/9] md:aspect-[3/1] bg-surface-container-highest" id="home-carousel">
            <!-- Slides Container -->
            <div class="relative w-full h-full overflow-hidden">
                <!-- Slide 1 -->
                <div class="carousel-slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-100 z-10" data-index="0">
                    <div class="absolute inset-0 bg-cover bg-center"
                        style="background-image: url('{{ \App\Models\Setting::getValue('banner_image_1', 'https://lh3.googleusercontent.com/aida-public/AB6AXuBUPmxzypNMHfMiYkCk7Yr3kM65t-hMJ0O092cof5zHs0u_3B85M93vvm2RS5ILaCiGFm4QYg_tERKUFK2gDDlkLdZyktGbIAWYY2-ZHlvFpZoerJ8wdppF-Jc-92jB7_Z0MEYqvv3Dv2dxZ1OHJ8CkFxCMcaKw1yztrVQKFSNmg-Bs0h_qr_0dTzOzPLaWdBbYYPmTEJZGpn5FjJFm4105slvqkpzKeD11BiIeed7wKtMg6cEbGIl9Fg') }}')">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-transparent flex items-center px-10">
                        <div class="max-w-md text-white">
                            <h2 class="font-headline-lg text-headline-lg mb-4 drop-shadow-md">{{ \App\Models\Setting::getValue('banner_title_1', 'Solusi Kesehatan Hewan Terpercaya') }}</h2>
                            <p class="font-body-md text-body-md mb-6 opacity-90">{{ \App\Models\Setting::getValue('banner_subtitle_1', 'Distributor resmi obat-obatan.') }}</p>
                            <a href="{{ \App\Models\Setting::getValue('banner_link_1', '/') }}" class="inline-block bg-secondary px-8 py-3 rounded-full font-label-md text-label-md text-white hover:bg-secondary/95 transition-all active:scale-95 shadow-md">
                                Cek Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-0 z-0" data-index="1">
                    <div class="absolute inset-0 bg-cover bg-center"
                        style="background-image: url('{{ \App\Models\Setting::getValue('banner_image_2', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDNxN7bLDYs8Ntog2UEH9rEQ3MqMQsWH05Nlpd8cyoxY4qqWd51rfLp6xNZKG_-fbR-d-8lDLlF1wxSF7AGb-OKlGoHDpxL-_BiUB8PsacJlwFD74W0LEMD7mkiCiM66QErUnJGAXRc8tgjPK-K7BL-yHWb6gHoPDRutAkq6fj2gRdWvaQCNTgO8whNvBGfjiTVzRNyHo51zitvWaxQWVdlcOW6MxzWJP3pax2TzhjhGGDyL_4VgOiJOg') }}')">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-transparent flex items-center px-10">
                        <div class="max-w-md text-white">
                            <h2 class="font-headline-lg text-headline-lg mb-4 drop-shadow-md">{{ \App\Models\Setting::getValue('banner_title_2', 'Grosir Peralatan Medis Hewan') }}</h2>
                            <p class="font-body-md text-body-md mb-6 opacity-90">{{ \App\Models\Setting::getValue('banner_subtitle_2', 'Dapatkan penawaran harga khusus.') }}</p>
                            <a href="{{ \App\Models\Setting::getValue('banner_link_2', '/') }}" class="inline-block bg-secondary px-8 py-3 rounded-full font-label-md text-label-md text-white hover:bg-secondary/95 transition-all active:scale-95 shadow-md">
                                Cek Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-slide absolute inset-0 transition-opacity duration-700 ease-in-out opacity-0 z-0" data-index="2">
                    <div class="absolute inset-0 bg-cover bg-center"
                        style="background-image: url('{{ \App\Models\Setting::getValue('banner_image_3', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAsco9lh2Q-joVp6ZTwjlxnzoeZpSMUw6vSbmQaga5WcntUTjOjDTf_Z1UszVdBkHZT-pOPZemlyOeoBeVo35Y7uXesVXGZx-9HEOOkHhPcrQB2vtIazFadN06zCbm7-vAIpKX7SRno6SfeV09dE-XxUus_9SMDpx8rTHU7aptiIMDh2bRYlyUwrqnZPQjOm8XikCEclkwYTow0duoQ6cUOND1JClnNl9-u4dP2fsvSdh-g4ExJqWuzHQ') }}')">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-transparent flex items-center px-10">
                        <div class="max-w-md text-white">
                            <h2 class="font-headline-lg text-headline-lg mb-4 drop-shadow-md">{{ \App\Models\Setting::getValue('banner_title_3', 'Suplemen & Nutrisi Hewan Premium') }}</h2>
                            <p class="font-body-md text-body-md mb-6 opacity-90">{{ \App\Models\Setting::getValue('banner_subtitle_3', 'Tingkatkan daya tahan ternak.') }}</p>
                            <a href="{{ \App\Models\Setting::getValue('banner_link_3', '/') }}" class="inline-block bg-secondary px-8 py-3 rounded-full font-label-md text-label-md text-white hover:bg-secondary/95 transition-all active:scale-95 shadow-md">
                                Cek Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination Indicators -->
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-20">
                <button class="carousel-dot w-2.5 h-2.5 rounded-full bg-white shadow-sm transition-all" data-index="0"></button>
                <button class="carousel-dot w-2.5 h-2.5 rounded-full bg-white/40 border border-white/20 shadow-sm transition-all" data-index="1"></button>
                <button class="carousel-dot w-2.5 h-2.5 rounded-full bg-white/40 border border-white/20 shadow-sm transition-all" data-index="2"></button>
            </div>
        </section>
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

        <!-- Category Tabs -->
        <section class="mb-lg border-b border-outline-variant flex items-end gap-md overflow-x-auto hide-scrollbar">
            <a href="{{ route('home', ['category' => 'all']) }}"
                class="pb-3 px-2 {{ $selectedCategory == 'all' ? 'border-b-4 border-primary text-primary' : 'text-on-surface-variant hover:text-primary' }} font-label-md text-label-md whitespace-nowrap transition-all">For You</a>
            @foreach($categories as $cat)
                <a href="{{ route('home', ['category' => $cat->slug]) }}"
                    class="pb-3 px-2 {{ $selectedCategory == $cat->slug ? 'border-b-4 border-primary text-primary' : 'text-on-surface-variant hover:text-primary' }} font-label-md text-label-md whitespace-nowrap transition-all">{{ $cat->name }}</a>
            @endforeach
        </section>

        <!-- Product Grid -->
        <section class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-sm md:gap-gutter mb-xl">
            @forelse($products as $prod)
                <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant hover:shadow-md transition-all group overflow-hidden flex flex-col justify-between">
                    <a href="{{ route('product.show', $prod->slug) }}" class="flex flex-col flex-grow">
                        <div class="relative aspect-square">
                            @if(Str::startsWith($prod->image, 'http'))
                                <img class="w-full h-full object-cover" src="{{ $prod->image }}" alt="{{ $prod->name }}" />
                            @else
                                <img class="w-full h-full object-cover" src="{{ asset($prod->image) }}" alt="{{ $prod->name }}" />
                            @endif
                        </div>
                        <div class="p-3 flex flex-col flex-grow">
                            <h3 class="font-body-md text-on-surface line-clamp-2 mb-1 group-hover:text-primary transition-colors">
                                {{ $prod->name }}
                            </h3>
                            <div class="mt-auto">
                                <p class="font-label-md text-label-md text-primary mb-1">Rp {{ number_format($prod->price, 0, ',', '.') }}</p>
                                <div class="flex items-center gap-1 mb-1">
                                    <span class="material-symbols-outlined text-secondary text-[14px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                    <span class="text-caption font-caption text-on-surface-variant">{{ number_format($prod->rating, 1) }} | {{ $prod->sold_count }}+ terjual</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="px-3 pb-3">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $prod->id }}" />
                            <input type="hidden" name="quantity" value="1" />
                            <button type="submit" class="w-full bg-secondary-container text-on-secondary-container rounded-lg py-1.5 font-label-md text-[13px] flex items-center justify-center gap-xs hover:opacity-90 active:scale-95 transition-all">
                                <span class="material-symbols-outlined text-[16px]">shopping_cart</span>
                                + Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-8 text-center text-muted">
                    Tidak ada produk obat hewan yang tersedia untuk kategori ini.
                </div>
            @endforelse
        </section>
        <!-- Bento Grid Feature Section -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-md mb-xl">
            <a href="{{ \App\Models\Setting::getValue('banner_link', '/') }}" class="md:col-span-2 relative h-64 rounded-2xl overflow-hidden shadow-sm group">
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                    style="background-image: url('{{ \App\Models\Setting::getValue('banner_image', 'https://lh3.googleusercontent.com/aida-public/AB6AXuDNxN7bLDYs8Ntog2UEH9rEQ3MqMQsWH05Nlpd8cyoxY4qqWd51rfLp6xNZKG_-fbR-d-8lDLlF1wxSF7AGb-OKlGoHDpxL-_BiUB8PsacJlwFD74W0LEMD7mkiCiM66QErUnJGAXRc8tgjPK-K7BL-yHWb6gHoPDRutAkq6fj2gRdWvaQCNTgO8whNvBGfjiTVzRNyHo51zitvWaxQWVdlcOW6MxzWJP3pax2TzhjhGGDyL_4VgOiJOg') }}')">
                </div>
                <div
                    class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/20 to-transparent p-8 flex flex-col justify-end">
                    <h2 class="font-headline-md text-headline-md text-white mb-2">{{ \App\Models\Setting::getValue('banner_title', 'Grosir Peralatan Medis') }}</h2>
                    <p class="font-body-md text-white/90">{{ \App\Models\Setting::getValue('banner_subtitle', 'Dapatkan harga khusus untuk pembelanjaan partai besar klinik dan instansi.') }}</p>
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
