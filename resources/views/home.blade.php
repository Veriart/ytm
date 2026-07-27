@extends('layout')
@section('content')
    <main class="w-full max-w-[1280px] mx-auto px-margin-mobile md:px-margin-desktop py-md">
        <!-- Hero Section: Carousel/Banner -->
        <section class="mb-lg overflow-hidden rounded-xl shadow-lg group relative">
            <div class="relative w-full aspect-[21/9] md:aspect-[3/1] bg-surface-container-highest">
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                    data-alt="A wide professional medical banner showing high-quality veterinary equipment and pet medicine bottles arranged on a clean white laboratory surface. Soft turquoise teal lighting creates a clinical yet trustworthy atmosphere. Professional PT Yakin Tri Medika pharmaceutical products are displayed with a sense of care and premium medical precision."
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBUPmxzypNMHfMiYkCk7Yr3kM65t-hMJ0O092cof5zHs0u_3B85M93vvm2RS5ILaCiGFm4QYg_tERKUFK2gDDlkLdZyktGbIAWYY2-ZHlvFpZoerJ8wdppF-Jc-92jB7_Z0MEYqvv3Dv2dxZ1OHJ8CkFxCMcaKw1yztrVQKFSNmg-Bs0h_qr_0dTzOzPLaWdBbYYPmTEJZGpn5FjJFm4105slvqkpzKeD11BiIeed7wKtMg6cEbGIl9Fg')">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-black/40 to-transparent flex items-center px-10">
                    <div class="max-w-md text-white">
                        <h1 class="font-headline-lg text-headline-lg mb-4 drop-shadow-md">Solusi Kesehatan Hewan
                            Terpercaya</h1>
                        <p class="font-body-md text-body-md mb-6 opacity-90">Distributor resmi obat-obatan dan peralatan
                            medis berkualitas untuk klinik dan apotek hewan.</p>
                        <button
                            class="bg-secondary px-8 py-3 rounded-full font-label-md text-label-md text-white hover:bg-secondary-container transition-all active:scale-95 shadow-md">
                            Cek Sekarang
                        </button>
                    </div>
                </div>
                <!-- Pagination Indicators -->
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                    <div class="w-2.5 h-2.5 rounded-full bg-white shadow-sm"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-white/40 border border-white/20"></div>
                    <div class="w-2.5 h-2.5 rounded-full bg-white/40 border border-white/20"></div>
                </div>
            </div>
        </section>
        <!-- Category Tabs -->
        <section class="mb-lg border-b border-outline-variant flex items-end gap-md overflow-x-auto hide-scrollbar">
            <button
                class="pb-3 px-2 border-b-4 border-primary text-primary font-label-md text-label-md whitespace-nowrap">For
                You</button>
            <button
                class="pb-3 px-2 text-on-surface-variant hover:text-primary font-label-md text-label-md whitespace-nowrap transition-colors">Terlaris</button>
            <button
                class="pb-3 px-2 text-on-surface-variant hover:text-primary font-label-md text-label-md whitespace-nowrap transition-colors">Obat
                Rutin</button>
            <button
                class="pb-3 px-2 text-on-surface-variant hover:text-primary font-label-md text-label-md whitespace-nowrap transition-colors">Vaksin</button>
            <button
                class="pb-3 px-2 text-on-surface-variant hover:text-primary font-label-md text-label-md whitespace-nowrap transition-colors">Suplemen</button>
        </section>
        <!-- Product Grid -->
        <section class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-sm md:gap-gutter mb-xl">
            <!-- Product Card 1 -->
            <div
                class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant hover:shadow-md transition-all group overflow-hidden flex flex-col">
                <a href="/product">
                    <div class="relative aspect-square">
                        <img class="w-full h-full object-cover"
                            data-alt="A bottle of professional veterinary heartworm preventive medicine for dogs, standing on a clean white clinical background. The packaging is professional with teal and white branding, clearly showing pharmaceutical labeling. High-key lighting, professional product photography for a medical distributor catalog."
                            src="/img/product/oralade.webp" />
                    </div>
                    <div class="p-3 flex flex-col flex-grow">
                        <h3
                            class="font-body-md text-on-surface line-clamp-2 mb-1 group-hover:text-primary transition-colors">
                            NexGard Spectra L (30-60kg) Dog Parasite Treatment</h3>
                        <div class="mt-auto">
                            <p class="font-label-md text-label-md text-primary mb-1">Rp 485.000</p>
                            <div class="flex items-center gap-1 mb-2">
                                <span class="material-symbols-outlined text-secondary text-[14px]"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-caption font-caption text-on-surface-variant">4.9 | 2rb+ terjual</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Product Card 2 -->
            <div
                class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant hover:shadow-md transition-all group overflow-hidden flex flex-col">
                <div class="relative aspect-square">
                    <img class="w-full h-full object-cover"
                        data-alt="A professional cat medical supplement gel tube for digestive health. The tube is white with teal accents and features clinical diagrams of a cat's health. Placed on a sterile, well-lit medical tray. The style is clean, modern, and pharmaceutical-grade."
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCiRKO8ARPsKgS00nWiiCL8p1_04_1Y7RKc1Z_NR7At3op_MOgkGZajrxu0ERA51clh9SMWzll6zPhA5i1lVN_19L9I0ISBVQWaujDxRAHD8MZ6jzWtQOR4DDkBODa6lfPr5pYXXrwrvKWNHzT7I3rw32TKzfABvIvuL9MsJT1HVAPknasFtB_WP46qr7qWVLqWnbAReBiP4Vp3B2_ok7-YO1p7tBs8jKPY01bLmaPcAHtkjzUxQdwbBQ" />
                </div>
                <div class="p-3 flex flex-col flex-grow">
                    <h3 class="font-body-md text-on-surface line-clamp-2 mb-1 group-hover:text-primary transition-colors">
                        Vetoquinol Laxatone Cat Digestive Health 120g</h3>
                    <div class="mt-auto">
                        <p class="font-label-md text-label-md text-primary mb-1">Rp 125.000</p>
                        <div class="flex items-center gap-1 mb-2">
                            <span class="material-symbols-outlined text-secondary text-[14px]"
                                style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="text-caption font-caption text-on-surface-variant">5.0 | 500+ terjual</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Card 3 -->
            <div
                class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant hover:shadow-md transition-all group overflow-hidden flex flex-col">
                <div class="relative aspect-square">
                    <img class="w-full h-full object-cover"
                        data-alt="Pharmaceutical bottle of antibiotics for livestock, large animals. The label shows a silhouette of a cow and horse. Professional medical design, clear liquid content visible in a dark glass bottle. Studio lighting on a neutral gray background."
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuA9rCsuxfj37HDrp4pTaI6Fz4YYG4ASsItscR6e_zJiyBcI2JD2CiDQUWZTQzLTinMn3BYhmcoXiXCSOGfEshzohL7o8YMmwCwd4UbbutPvyrFLpw27Yl7InyF78PBKN0644XdgTG_PbnKqWWQeJwlwE2nPTVbGzZyqtr7EiC3NyRvlLSf4EamMozh1EJ7DEateKIDWlqtkSysXCLq3MpaCTDHpqP0UL3XzCwm2F_x2VKtJRE-5doh6kg" />
                </div>
                <div class="p-3 flex flex-col flex-grow">
                    <h3 class="font-body-md text-on-surface line-clamp-2 mb-1 group-hover:text-primary transition-colors">
                        Penstrep-400 Livestock Injectable Solution 100ml</h3>
                    <div class="mt-auto">
                        <p class="font-label-md text-label-md text-primary mb-1">Rp 210.000</p>
                        <div class="flex items-center gap-1 mb-2">
                            <span class="material-symbols-outlined text-secondary text-[14px]"
                                style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="text-caption font-caption text-on-surface-variant">4.8 | 150+ terjual</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Card 4 -->
            <div
                class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant hover:shadow-md transition-all group overflow-hidden flex flex-col">
                <div class="relative aspect-square">
                    <img class="w-full h-full object-cover"
                        data-alt="High-quality bird supplement vitamins in a dropper bottle for pet birds. Bright packaging with tropical bird illustrations. Clinical pharmaceutical setting, soft morning light, focus on the product labels."
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAsco9lh2Q-joVp6ZTwjlxnzoeZpSMUw6vSbmQaga5WcntUTjOjDTf_Z1UszVdBkHZT-pOPZemlyOeoBeVo35Y7uXesVXGZx-9HEOOkHhPcrQB2vtIazFadN06zCbm7-vAIpKX7SRno6SfeV09dE-XxUus_9SMDpx8rTHU7aptiIMDh2bRYlyUwrqnZPQjOm8XikCEclkwYTow0duoQ6cUOND1JClnNl9-u4dP2fsvSdh-g4ExJqWuzHQ" />
                </div>
                <div class="p-3 flex flex-col flex-grow">
                    <h3 class="font-body-md text-on-surface line-clamp-2 mb-1 group-hover:text-primary transition-colors">
                        Multi-Vite Bird Liquid Supplement 30ml</h3>
                    <div class="mt-auto">
                        <p class="font-label-md text-label-md text-primary mb-1">Rp 65.000</p>
                        <div class="flex items-center gap-1 mb-2">
                            <span class="material-symbols-outlined text-secondary text-[14px]"
                                style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="text-caption font-caption text-on-surface-variant">4.9 | 1rb+ terjual</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Card 5 -->
            <div
                class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant hover:shadow-md transition-all group overflow-hidden flex flex-col">
                <div class="relative aspect-square">
                    <img class="w-full h-full object-cover"
                        data-alt="Professional grade flea and tick collar for large dogs in a sleek metal tin. The branding is modern and premium. Neutral background with soft shadows, highlighting the protective nature of the medical product."
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuADoQKh4kHJyYJX15swcfzQi0ZjedUy7dzTzK6wLYls3io0jadjUNm9VnXxKj2Tau2kDDgEfLxiBDh-Hj4oP1pV7kOY-xbOMWg3rGYytvanmduF3EHAr_eM_dnewrCCkSB3KFOXmEzaJ7neIP-s3WU2mq8hBW6oRMN7sOQdzVtmqyQ2ltDxXPOWqd5_5HGcDIMWV0Ap57VQM9uFuGCGZmnUAcmOs2YgtM7-7PQpzfmb9kdLkxa1KdxwKA" />
                </div>
                <div class="p-3 flex flex-col flex-grow">
                    <h3 class="font-body-md text-on-surface line-clamp-2 mb-1 group-hover:text-primary transition-colors">
                        Seresto Flea & Tick Collar for Large Dogs (8kg+)</h3>
                    <div class="mt-auto">
                        <p class="font-label-md text-label-md text-primary mb-1">Rp 615.000</p>
                        <div class="flex items-center gap-1 mb-2">
                            <span class="material-symbols-outlined text-secondary text-[14px]"
                                style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="text-caption font-caption text-on-surface-variant">5.0 | 3rb+ terjual</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Card 6 -->
            <div
                class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant hover:shadow-md transition-all group overflow-hidden flex flex-col">
                <div class="relative aspect-square">
                    <img class="w-full h-full object-cover"
                        data-alt="A box of professional feline joint health supplements. Packaging shows a healthy active cat and ingredients list like glucosamine. Medical distributor aesthetic, clean and crisp photography with turquoise accents."
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCbdWejtKNGPBvvCPcMQIhozmR4w3UavPTR7bpvnfUABVPhLVNtO3zDFRax4QVZ5MV3HmvQ89WcX-SugCiuPPq2KG9hWTZecvFyLVdBij-DsicohQKBKzs7_OcefpGAfGsvQPWcPZyP8SpFfoTJu1Fs4gEkdZ9Lz8ElmA_jf4X3SaVUO3TGjQSA59XbAy2Y9QAN9cUvDvzvQNU3c0xsuY3jJsRX_iRoXgxqmTydg-05WEokcpiCTtnSXQ" />
                </div>
                <div class="p-3 flex flex-col flex-grow">
                    <h3 class="font-body-md text-on-surface line-clamp-2 mb-1 group-hover:text-primary transition-colors">
                        Cosequin Joint Health Cat Supplements 80 Capsules</h3>
                    <div class="mt-auto">
                        <p class="font-label-md text-label-md text-primary mb-1">Rp 340.000</p>
                        <div class="flex items-center gap-1 mb-2">
                            <span class="material-symbols-outlined text-secondary text-[14px]"
                                style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="text-caption font-caption text-on-surface-variant">4.9 | 800+ terjual</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bento Grid Feature Section -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-md mb-xl">
            <div class="md:col-span-2 relative h-64 rounded-2xl overflow-hidden shadow-sm group">
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                    data-alt="A wide professional shot of a modern veterinary pharmacy warehouse with neatly organized shelves of animal medicines. Teal and orange branding elements visible. The lighting is bright and industrial-modern, conveying efficiency and scale."
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDNxN7bLDYs8Ntog2UEH9rEQ3MqMQsWH05Nlpd8cyoxY4qqWd51rfLp6xNZKG_-fbR-d-8lDLlF1wxSF7AGb-OKlGoHDpxL-_BiUB8PsacJlwFD74W0LEMD7mkiCiM66QErUnJGAXRc8tgjPK-K7BL-yHWb6gHoPDRutAkq6fj2gRdWvaQCNTgO8whNvBGfjiTVzRNyHo51zitvWaxQWVdlcOW6MxzWJP3pax2TzhjhGGDyL_4VgOiJOg')">
                </div>
                <div
                    class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/20 to-transparent p-8 flex flex-col justify-end">
                    <h2 class="font-headline-md text-headline-md text-white mb-2">Grosir Peralatan Medis</h2>
                    <p class="font-body-md text-white/90">Dapatkan harga khusus untuk pembelanjaan partai besar klinik
                        dan instansi.</p>
                </div>
            </div>
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
