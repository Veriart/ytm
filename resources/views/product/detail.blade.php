@extends('layout')

@section('content')
    <main class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin-desktop py-md">
        <!-- Product Hero Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
            <!-- Left: Imagery & Gallery -->
            <div class="lg:col-span-7 space-y-sm">
                <div
                    class="bento-card bg-surface-container-lowest rounded-xl overflow-hidden aspect-[4/3] flex items-center justify-center border border-outline-variant">
                    <img class="w-full h-full object-cover"
                        data-alt="A clean, clinical product shot of a premium veterinary medication bottle, high-key lighting, soft teal accents, white medical surface background. The packaging is professional and minimalist, showing clear pharmacy-grade labeling. Macro photography style with shallow depth of field, emphasizing reliability and medical precision."
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBXeHJTzVy-6gWv8oHs2pH8ngEBJAlty7N9Cz9DC6MbQk39aSroSDCkdGON_bIHKjmq_tMnCEDdlZtmsvxEzXp-qSWvB-sEAyIZZKESsvSSdEVqAxlgirCcrQKqicHmC4XksQoeB6c9ZCi1JGosSlgdCTZGQK3J-zrshMDXp3BHoPuAE3x7HgLqkHvGN0yaducUcO2s_nq6nUxVqqGtcK7cii--NnCNHcBQbm-d5uaBmF47a983AQ1Q1g" />
                </div>
            </div>
            <!-- Right: Buy Box & Core Info -->
            <div class="lg:col-span-5 space-y-gutter">
                <div class="bg-surface-container-lowest rounded-xl p-md border border-outline-variant shadow-sm space-y-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-primary font-label-md text-label-md tracking-wider">APOQUEL®
                            (OCLACITINIB)</span>
                    </div>
                    <h1 class="font-headline-lg text-headline-lg text-on-surface">Medicated Treatment for Allergic
                        Itching &amp; Atopic Dermatitis</h1>
                    <div class="flex items-baseline gap-xs">
                        <span class="text-on-surface font-headline-md text-headline-md">Rp 150.000,-</span>
                    </div>
                    <div class="flex items-center gap-xs">
                        <div class="flex text-secondary">
                            <span class="material-symbols-outlined text-[18px]"
                                style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px]"
                                style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px]"
                                style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px]"
                                style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px]">star_half</span>
                        </div>
                        <span class="text-outline text-label-md font-label-md">4.8 (1,240 Reviews)</span>
                    </div>
                    <hr class="border-outline-variant" />
                    {{-- <div class="space-y-sm">
                        <p class="font-label-md text-label-md text-on-surface">Select Strength:</p>
                        <div class="flex flex-wrap gap-xs">
                            <button
                                class="px-sm py-2 rounded-lg border-2 border-primary bg-primary-container/10 text-primary font-label-md text-label-md">3.6mg</button>
                            <button
                                class="px-sm py-2 rounded-lg border border-outline-variant text-on-surface-variant hover:border-primary transition-colors font-label-md text-label-md">5.4mg</button>
                            <button
                                class="px-sm py-2 rounded-lg border border-outline-variant text-on-surface-variant hover:border-primary transition-colors font-label-md text-label-md">16mg</button>
                        </div>
                    </div> --}}

                    <div class="flex gap-sm">
                        <div class="w-32 flex items-center border border-outline-variant rounded-lg overflow-hidden h-12">
                            <button class="flex-1 h-full hover:bg-surface-container transition-colors qty-min">-</button>
                            <span class="w-10 text-center font-label-md qty-val">1</span>
                            <button class="flex-1 h-full hover:bg-surface-container transition-colors qty-plus">+</button>
                        </div>
                        <button
                            class="flex-1 bg-secondary-container text-on-secondary-container rounded-lg font-label-md text-label-md h-12 flex items-center justify-center gap-xs hover:opacity-90 active:scale-95 transition-all">
                            <span class="material-symbols-outlined">shopping_bag</span>
                            Add to Cart
                        </button>
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
                    <h2 class="font-headline-md text-headline-md">Clinical Guidelines &amp; Dosage</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-md">
                    <div class="space-y-xs">
                        <h4 class="font-label-md text-label-md text-primary">Administration</h4>
                        <p class="text-body-md text-on-surface-variant leading-relaxed">
                            Should be administered twice daily for up to 14 days, then once daily for maintenance. May
                            be given with or without food as a convenient treat-sized tablet.
                        </p>
                    </div>
                    <div class="space-y-xs">
                        <h4 class="font-label-md text-label-md text-primary">Indication</h4>
                        <p class="text-body-md text-on-surface-variant leading-relaxed">
                            Specifically formulated for control of pruritus associated with allergic dermatitis and
                            control of atopic dermatitis in dogs at least 12 months of age.
                        </p>
                    </div>
                </div>
                <div class="p-sm bg-surface rounded-lg border-l-4 border-primary">
                    <p class="font-label-md text-label-md mb-1">Pharmacist Note:</p>
                    <p class="text-body-md text-on-surface-variant">Store at controlled room temperature 20° to 25°C
                        (68° to 77°F). Excursions permitted between 15° to 40°C.</p>
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
    </main>
@endsection
@push('script')
    <script>
        const qtyVal = document.querySelector('.qty-val');
        const qtyPlus = document.querySelector('.qty-plus');
        const qtyMin = document.querySelector('.qty-min');

        qtyPlus.addEventListener('click', () => {
            qtyVal.textContent = Number(qtyVal.textContent) + 1;
        });

        qtyMin.addEventListener('click', () => {
            if (qtyVal.textContent > 1) {
                qtyVal.textContent = Number(qtyVal.textContent) - 1;
            }
        });
    </script>
@endpush
