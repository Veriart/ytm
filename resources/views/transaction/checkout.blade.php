@extends('layout')
@section('content')
    <main class="w-full pt-8 bg-surface mb-5 min-h-screen">
        <div class="flex flex-col w-full">
            <!-- Dynamic Progress Indicator -->
            <div class="w-full bg-surface-container-low px-margin-desktop py-base mb-md">
                <div class="max-w-[1280px] mx-auto flex items-center gap-sm">
                    <div class="flex items-center gap-xs">
                        <span
                            class="w-6 h-6 rounded-full bg-primary text-on-primary flex items-center justify-center text-caption font-bold">1</span>
                        <span class="text-label-md text-primary">Cart</span>
                    </div>
                    <div class="h-[2px] w-12 bg-primary"></div>
                    <div class="flex items-center gap-xs">
                        <span
                            class="w-6 h-6 rounded-full bg-primary text-on-primary flex items-center justify-center text-caption font-bold">2</span>
                        <span class="text-label-md text-primary">Checkout</span>
                    </div>
                    <div class="h-[2px] w-12 bg-outline-variant"></div>
                    <div class="flex items-center gap-xs opacity-50">
                        <span
                            class="w-6 h-6 rounded-full bg-surface-container-highest text-on-surface-variant flex items-center justify-center text-caption font-bold">3</span>
                        <span class="text-label-md text-on-surface-variant">Payment</span>
                    </div>
                </div>
            </div>
            <div class="max-w-[1280px] mx-auto px-margin-desktop w-full grid grid-cols-1 lg:grid-cols-12 gap-xl">
                <!-- Left Column: Order Details -->
                <div class="lg:col-span-8 space-y-lg">
                    <!-- Section: Delivery Address -->
                    <section class="space-y-md">
                        <div class="flex items-center justify-between">
                            <h2 class="font-headline-md text-on-surface flex items-center gap-xs">
                                <span class="material-symbols-outlined text-primary">location_on</span>
                                Alamat Pengiriman
                            </h2>
                            <button
                                class="text-label-md text-primary hover:bg-primary/5 px-4 py-2 rounded-lg transition-colors">Ganti
                                Alamat</button>
                        </div>
                        <div class="bg-surface-container-lowest p-md rounded-xl shadow-sm border-l-4 border-primary">
                            <div class="flex justify-between items-start mb-xs">
                                <div class="flex items-center gap-xs">
                                    <span class="font-label-md text-on-surface">Rumah (Utama)</span>
                                    <span
                                        class="bg-primary/10 text-primary text-[10px] px-2 py-0.5 rounded font-bold uppercase tracking-tighter">Default</span>
                                </div>
                                <span class="text-label-md text-on-surface font-bold">Budi Santoso</span>
                            </div>
                            <p class="text-body-md text-on-surface-variant">0812-3456-7890</p>
                            <p class="text-body-md text-on-surface-variant mt-xs leading-relaxed">
                                Jl. Gajah Mada No. 123, Komplek Medika Permai, <br />
                                Kec. Gambir, Jakarta Pusat, DKI Jakarta 10130
                            </p>
                        </div>
                    </section>
                    <!-- Section: Order List -->
                    <section class="space-y-md">
                        <h2 class="font-headline-md text-on-surface flex items-center gap-xs">
                            <span class="material-symbols-outlined text-primary">medication</span>
                            Daftar Pesanan
                        </h2>
                        <!-- Cart Items Container -->
                        <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                            <!-- Item 1 -->
                            <div class="p-md flex gap-md group border-b border-surface-container">
                                <div class="w-24 h-24 rounded-lg bg-surface-container-low overflow-hidden flex-shrink-0">
                                    <img class="w-full h-full object-cover"
                                        data-alt="High-resolution pharmaceutical product shot of Cefpodoxime Proxetil Tablets in professional clinical packaging, clean white background, studio lighting, medical teal accents"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAI70ld4wN-apUVRWZzfohYhatFSOnCtkG9-zCM0WIkGbz_SGr4TeadqaXq63M3rftXLIJptt4-s0FFQjn3OyJ_GwkFbW6HJERiLlm2LdiniU3UEFgseI6WSXLbG6iC6oGYMy1sR0Mem7nHjcQ0IM7gEB7Vidk8HV1pdrmAYgOy4yxRz---U60JJ_ng5udYd39e-yGPQlqII5OaPvrq3kD7-P-SDRfPaS7ACrmm2SSZC45NO_mAY3CnRE7S77qpKnT9Z75Ufnh_JXPh" />
                                </div>
                                <div class="flex-1 flex flex-col justify-between">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-label-md text-on-surface text-lg">Cefpodoxime Proxetil Tablets
                                                (200mg)</h3>
                                            <p class="text-caption text-on-surface-variant">Voucher Applied: MEDICINE10</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-label-md text-on-surface">Rp 245.000</p>
                                            <p class="text-caption text-on-surface-variant">1 Unit</p>
                                        </div>
                                    </div>
                                    <div class="mt-base">
                                        <input
                                            class="w-full bg-surface-container-low text-caption py-2 px-3 rounded-lg border-none focus:ring-1 focus:ring-primary outline-none transition-all"
                                            placeholder="Tulis catatan untuk pesanan ini..." type="text" />
                                    </div>
                                </div>
                            </div>
                            <!-- Item 2 -->
                            <div class="p-md flex gap-md group">
                                <div class="w-24 h-24 rounded-lg bg-surface-container-low overflow-hidden flex-shrink-0">
                                    <img class="w-full h-full object-cover"
                                        data-alt="NutriPlus Gel for pets, energy supplement tube, clinical pharmaceutical photography, high contrast lighting, sterile environment"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDs4Z386MRoYBywEWHjqHKXCYQv9fdwtu05uFBjpWRrJgUcAxgpdBD-FM1t0W5Owc54Zk1n6dWmKz-GSUpkbIMARbP4WZ3phUxie5_UYHYB5brJobTjNq2zz0IHK9R8NuTHLsFXwgO6vSUAQfSRoV8MziPRMxxLoXPKzIyUP_8b0jHf8ndiRilr12aZAfO594h8tScZz17kUGcuq3ybnJq56U18PsZ_vAD2iaLtDgMsMWZmnjPN1dSCLEkTrWXbArWhKL_QDDEWz673" />
                                </div>
                                <div class="flex-1 flex flex-col justify-between">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-label-md text-on-surface text-lg">NutriPlus Gel High Energy
                                                Supplement</h3>
                                            <p class="text-caption text-on-surface-variant">Voucher Applied: -</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-label-md text-on-surface">Rp 120.000</p>
                                            <p class="text-caption text-on-surface-variant">2 Units</p>
                                        </div>
                                    </div>
                                    <div class="mt-base">
                                        <input
                                            class="w-full bg-surface-container-low text-caption py-2 px-3 rounded-lg border-none focus:ring-1 focus:ring-primary outline-none transition-all"
                                            placeholder="Tulis catatan untuk pesanan ini..." type="text" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Courier Selection -->
                    <section class="bg-surface-container-low p-md rounded-xl">
                        <h3 class="font-label-md text-on-surface mb-sm flex items-center gap-xs">
                            <span class="material-symbols-outlined text-[20px]">local_shipping</span>
                            Pilih Pengiriman
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-sm">
                            <button
                                class="p-md bg-surface-container-lowest rounded-lg text-left border-2 border-primary ring-2 ring-primary/10">
                                <div class="flex justify-between items-center mb-xs">
                                    <span class="font-label-md text-on-surface">Reguler (2-3 Hari)</span>
                                    <span class="text-label-md text-primary font-bold">Rp 15.000</span>
                                </div>
                                <p class="text-caption text-on-surface-variant">JNE Reguler / SiCepat Reg</p>
                            </button>
                            <button
                                class="p-md bg-surface-container-lowest rounded-lg text-left border border-outline-variant hover:border-primary transition-all">
                                <div class="flex justify-between items-center mb-xs">
                                    <span class="font-label-md text-on-surface">Express (1 Hari)</span>
                                    <span class="text-label-md text-on-surface">Rp 45.000</span>
                                </div>
                                <p class="text-caption text-on-surface-variant">JNE YES / Paxel</p>
                            </button>
                        </div>
                    </section>
                </div>
                <!-- Right Column: Sticky Summary -->
                <div class="lg:col-span-4">
                    <div class="sticky top-[88px] space-y-md">
                        <!-- Promo Section -->
                        <div class="bg-surface-container-lowest p-md rounded-xl shadow-md">
                            <button
                                class="w-full flex items-center justify-between group p-sm rounded-lg hover:bg-surface-container-high transition-all">
                                <div class="flex items-center gap-sm">
                                    <span class="material-symbols-outlined text-secondary">sell</span>
                                    <span class="font-label-md text-on-surface">Pakai promo biar makin hemat!</span>
                                </div>
                                <span
                                    class="material-symbols-outlined text-outline group-hover:translate-x-1 transition-transform">chevron_right</span>
                            </button>
                        </div>
                        <!-- Payment Method -->
                        <div class="bg-surface-container-lowest p-md rounded-xl shadow-md space-y-md">
                            <h3 class="font-label-md text-on-surface uppercase tracking-wider text-xs">Metode Pembayaran
                            </h3>
                            <div class="space-y-sm">
                                <div
                                    class="flex items-center justify-between p-sm rounded-lg bg-surface-container-low border border-primary/20">
                                    <div class="flex items-center gap-sm">
                                        <div
                                            class="w-10 h-6 bg-white rounded border border-outline-variant flex items-center justify-center font-bold text-[10px] text-blue-800">
                                            BCA</div>
                                        <span class="text-body-md text-on-surface">BCA Virtual Account</span>
                                    </div>
                                    <span class="material-symbols-outlined text-primary text-[20px]">check_circle</span>
                                </div>
                                <button
                                    class="w-full flex items-center gap-sm p-sm rounded-lg hover:bg-surface-container-high transition-all opacity-70">
                                    <div
                                        class="w-10 h-6 bg-white rounded border border-outline-variant flex items-center justify-center font-bold text-[10px] text-blue-500">
                                        MANDIRI</div>
                                    <span class="text-body-md text-on-surface">Mandiri Bill Payment</span>
                                </button>
                            </div>
                        </div>
                        <!-- Order Summary -->
                        <div class="bg-surface-container-lowest p-md rounded-xl shadow-md space-y-md">
                            <h3
                                class="font-label-md text-on-surface uppercase tracking-wider text-xs border-b border-surface-container pb-xs">
                                Ringkasan Transaksi</h3>
                            <div class="space-y-sm">
                                <div class="flex justify-between text-body-md text-on-surface-variant">
                                    <span>Total Harga (3 Barang)</span>
                                    <span>Rp 485.000</span>
                                </div>
                                <div class="flex justify-between text-body-md text-on-surface-variant">
                                    <span>Total Ongkos Kirim</span>
                                    <span>Rp 15.000</span>
                                </div>
                                <div class="flex justify-between text-body-md text-on-surface-variant">
                                    <span>Biaya Layanan</span>
                                    <span>Rp 1.000</span>
                                </div>
                                <div class="flex justify-between text-body-md text-primary font-bold">
                                    <span>Diskon Promo</span>
                                    <span>-Rp 25.000</span>
                                </div>
                            </div>
                            <div
                                class="pt-md border-t border-dashed border-outline-variant flex justify-between items-center">
                                <span class="font-headline-md text-on-surface">Total Tagihan</span>
                                <span class="font-display-lg text-primary text-[24px]">Rp 476.000</span>
                            </div>
                            <button
                                class="w-full bg-primary text-on-primary py-lg rounded-xl font-label-md text-lg hover:bg-primary-container active:scale-[0.98] transition-all shadow-lg shadow-primary/20">
                                Bayar Sekarang
                            </button>
                            <!-- Security Badges -->
                            <div class="pt-sm flex flex-col items-center gap-sm">
                                <div class="flex items-center gap-xs text-caption text-on-surface-variant">
                                    <span class="material-symbols-outlined text-[16px] text-primary">security</span>
                                    Safe and secure pharmaceutical fulfillment
                                </div>
                                <div class="flex justify-center items-center gap-lg grayscale opacity-60">
                                    <img alt="Logo" class="h-6"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDHiNkStwP0Qt-UFiJIjsEIcnyNZSKRT3jF3Q2iK-1yCs2CsvwyVLWK7ZrteyigLT491QTRd_eRUox7g3N37Qnc8hlrfkHeOyyeQL4BYX1AM9uEs_8rVlZnWSt7ZSieRFOWVz1_ObDAXjOHxhW13QPgVMB22LmOA7LIls-vLg7Uf5wZcQpZsSHT_kdKUxfN3_S-rhiyTLadpsOH47f5HmGelLdqGB_vzYxuXjX27PsX2bNuU1veTuMhgDRnGk2o5aujFXO4omdxV4Rp" />
                                    <span class="material-symbols-outlined text-[24px]">verified_user</span>
                                    <span class="material-symbols-outlined text-[24px]">health_and_safety</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Decorative Background Element -->
            <div class="fixed top-0 right-0 -z-10 w-1/3 h-full opacity-5 pointer-events-none">
                <svg class="w-full h-full" viewbox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
                    <path class="text-primary"
                        d="M44.7,-76.4C58.3,-69.2,70,-58.5,78.2,-45.5C86.4,-32.5,91,-16.3,90.2,-0.4C89.4,15.4,83.3,30.8,74.5,44.7C65.7,58.6,54.3,71,40.3,77.7C26.3,84.4,9.6,85.4,-6.1,82.4C-21.8,79.4,-36.5,72.4,-49.5,63.1C-62.5,53.8,-73.7,42.2,-79.8,28.4C-85.8,14.6,-86.7,-1.4,-83.4,-16.4C-80,-31.4,-72.4,-45.4,-61.4,-54.6C-50.5,-63.8,-36.2,-68.2,-22.6,-75.4C-9,-82.6,4,-92.6,17.4,-92.1C30.8,-91.6,31.1,-83.6,44.7,-76.4Z"
                        fill="currentColor" transform="translate(200 200)"></path>
                </svg>
            </div>
        </div>
        <script>
            // Simple interaction for address change simulation
            document.querySelectorAll('button').forEach(btn => {
                btn.addEventListener('click', function() {
                    if (this.innerText === 'Bayar Sekarang') {
                        const originalText = this.innerText;
                        this.innerHTML =
                            '<span class="animate-spin material-symbols-outlined">sync</span> Processing...';
                        this.disabled = true;
                        setTimeout(() => {
                            this.innerHTML =
                                '<span class="material-symbols-outlined">check_circle</span> Payment Secure';
                            this.classList.remove('bg-primary');
                            this.classList.add('bg-green-600');
                        }, 2000);
                    }
                });
            });
        </script>
    </main>
@endsection
