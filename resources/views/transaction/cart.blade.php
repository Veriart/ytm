@extends('layout')

@section('content')
    <main class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Keranjang</h1>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- LEFT COLUMN: Cart Items -->
            <section class="lg:col-span-2 space-y-4" data-purpose="cart-items-container">
                <!-- Selection Controller -->
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <input checked="" id="selectAll" class="w-5 h-5 rounded text-medical-500 focus:ring-medical-500"
                            type="checkbox" />
                        <label class="font-medium" for="selectAll" id="select-all-label">Pilih Semua (2)</label>
                    </div>
                    <button id="btn-delete-selected"
                        class="text-medical-500 font-semibold hover:text-medical-600 transition-colors">Hapus</button>
                </div>
                <!-- Store/Brand Header -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <!-- Cart Item 1 -->
                    <article class="p-4 flex flex-col md:flex-row border-b border-gray-50 last:border-0"
                        data-purpose="cart-item">
                        <div class="flex items-start space-x-3">
                            <input checked=""
                                class="mt-2 w-5 h-5 rounded text-medical-500 focus:ring-medical-500 item-checkbox"
                                type="checkbox" />
                            <div class="relative">
                                <img alt="Product 1" class="w-24 h-24 object-cover rounded-lg border"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDa9hcDn9WmrLwqP8kmOtwCduvvLiVIO9VSqwpmKdUBRo6xgXiUPq9ijiYClz2du6zOa-Jv21XqObwUCPEfbg12F3FqK_v0prjxkJLFwM5EGG1gzfzplJE1M6wBHTJJsNgiDSjla0GYfZwOHyor7upNwRIJhXqNGdMLRsTe1MGsVk4qxvvsC7xS6unhpveXQ4s-o-2ZZwmePYfALEmtxLcjnfSoU2_2VKtiUPVS7BrpDmBUo4xu8IcT7-GgqDTFF6FkCmoFJ1XwRPfA" />
                                <span
                                    class="absolute top-0 left-0 bg-red-500 text-white text-[10px] font-bold px-1 rounded-tl-lg rounded-br-lg">68%</span>
                            </div>
                        </div>
                        <div class="flex-1 mt-4 md:mt-0 md:ml-4">
                            <div class="flex justify-between">
                                <div>
                                    <h3 class="font-medium text-gray-900 leading-tight">Amoxicillin Trihydrate 500mg -
                                        Antibiotik Spektrum Luas</h3>
                                    <p class="text-sm text-gray-500 mt-1">Strip isi 10 Kaplet</p>
                                </div>
                                <div class="text-right">
                                    <span class="block font-bold text-lg item-price">Rp25.000</span>
                                </div>
                            </div>
                            <!-- Item Actions -->
                            <div class="flex items-center justify-end mt-4 space-x-4">
                                <button class="text-gray-400 hover:text-medical-500"><svg class="w-5 h-5" fill="none"
                                        stroke="currentColor" viewbox="0 0 24 24">
                                        <path
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    </svg></button>
                                <button class="text-gray-400 hover:text-red-500"><svg class="w-5 h-5" fill="none"
                                        stroke="currentColor" viewbox="0 0 24 24">
                                        <path
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    </svg></button>
                                <div class="flex items-center border rounded-lg h-8 px-2 space-x-4">
                                    <button class="text-medical-500 font-bold btn-qty" data-action="minus"
                                        data-id="1">-</button>
                                    <span class="text-sm font-medium w-4 text-center qty-val" data-id="1">1</span>
                                    <button class="text-medical-500 font-bold btn-qty" data-action="plus"
                                        data-id="1">+</button>
                                </div>
                            </div>
                        </div>
                    </article>
                    <!-- Cart Item 2 -->
                    <article class="p-4 flex flex-col md:flex-row" data-purpose="cart-item">
                        <div class="flex items-start space-x-3">
                            <input checked=""
                                class="mt-2 w-5 h-5 rounded text-medical-500 focus:ring-medical-500 item-checkbox"
                                type="checkbox" />
                            <div class="relative">
                                <img alt="Product 2" class="w-24 h-24 object-cover rounded-lg border"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAwcFj1toG-JeT_jLMoW4iuv2Sv4AItnzJpvcFNxePqm-qe9dulymstvnJIb9zA24YzrqeIRMmBXXNU71RjFoXXbQnKH9jxEVt7bhnWEhFXnNMlRofmcUx1X0Wmiq83N5_2fgNJ5vFp1f-3Hqi21mBQoyvwW4cewh3n5N7loG9RM5bgHBynchqzS3micd7Ap70urAFrbOo6dPBjeRpIG0qDe_eNq2kLIAXHyKdbSx6zTrKGXiFf3gLAJRqZrQw0tF2GWkZqXtvoPoY1" />
                                <span
                                    class="absolute top-0 left-0 bg-red-500 text-white text-[10px] font-bold px-1 rounded-tl-lg rounded-br-lg">64%</span>
                            </div>
                        </div>
                        <div class="flex-1 mt-4 md:mt-0 md:ml-4">
                            <div class="flex justify-between">
                                <div>
                                    <h3 class="font-medium text-gray-900 leading-tight">Vitamin C 1000mg - Suplemen Daya
                                        Tahan Tubuh</h3>
                                    <p class="text-sm text-gray-500 mt-1">Botol isi 30 Tablet</p>
                                </div>
                                <div class="text-right">
                                    <span class="block font-bold text-lg item-price">Rp25.000</span>
                                </div>
                            </div>
                            <!-- Item Actions -->
                            <div class="flex items-center justify-end mt-4 space-x-4">
                                <button class="text-gray-400 hover:text-medical-500"><svg class="w-5 h-5" fill="none"
                                        stroke="currentColor" viewbox="0 0 24 24">
                                        <path
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    </svg></button>
                                <button class="text-gray-400 hover:text-red-500"><svg class="w-5 h-5" fill="none"
                                        stroke="currentColor" viewbox="0 0 24 24">
                                        <path
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                    </svg></button>
                                <div class="flex items-center border rounded-lg h-8 px-2 space-x-4">
                                    <button class="text-medical-500 font-bold btn-qty" data-action="minus"
                                        data-id="2">-</button>
                                    <span class="text-sm font-medium w-4 text-center qty-val" data-id="2">1</span>
                                    <button class="text-medical-500 font-bold btn-qty" data-action="plus"
                                        data-id="2">+</button>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
            <!-- RIGHT COLUMN: Summary Card -->
            <aside class="lg:col-span-1">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-28"
                    data-purpose="order-summary-card">
                    <h2 class="font-bold text-lg mb-6">Ringkasan belanja</h2>
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-gray-600">Total</span>
                        <span class="text-xl font-bold" id="total-price">Rp70.000</span>
                    </div>
                    <!-- Buy Button -->
                    <button id="btn-buy" onclick="window.location.href='/checkout'"
                        class="w-full bg-primary text-white font-bold py-3 rounded-xl hover:bg-primary-600 transition-colors shadow-md shadow-medical-100">
                        Beli (2)
                    </button>
                    <!-- Disclaimer / Trust Info -->
                    <div class="mt-4 flex items-center justify-center space-x-2 text-xs text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                            <path
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                        </svg>
                        <span>Pembayaran Aman &amp; Terenkripsi</span>
                    </div>
                </div>
            </aside>
        </div>
    </main>
@endsection
@push('script')
    <script>
        $(document).ready(function() {

            // --- 1. UTILITY: Fungsi Hitung Total Harga & Jumlah Item Terpilih ---
            function updateCartSummary() {
                let totalHarga = 0;
                let selectedCount = 0;
                let totalItems = $('.item-checkbox').length;

                $('.item-checkbox').each(function() {
                    if ($(this).is(':checked')) {
                        selectedCount++;
                        let $article = $(this).closest('article');

                        // Ambil harga (misal: "Rp25.000" -> 25000)
                        let priceText = $article.find('.item-price').text();
                        let price = parseInt(priceText.replace(/[^0-9]/g, '')) || 0;

                        // Ambil kuantitas
                        let qty = parseInt($article.find('.qty-val').text()) || 0;

                        totalHarga += (price * qty);
                    }
                });

                // Update tampilan Total Harga
                $('#total-price').text('Rp' + totalHarga.toLocaleString('id-ID'));

                // Update Label & Tombol Beli
                $('#select-all-label').text('Pilih Semua (' + totalItems + ')');
                $('#btn-buy').text('Beli (' + selectedCount + ')');

                // Master Checkbox State (jika semua item tercentang manual)
                $('#selectAll').prop('checked', selectedCount === totalItems && totalItems > 0);
            }

            // --- 2. EVENT: Kuantitas Plus / Minus ---
            $(document).on('click', '.btn-qty', function() {
                let $btn = $(this);
                let id = $btn.data('id');
                let action = $btn.data('action');
                let $qtyTarget = $('.qty-val[data-id="' + id + '"]');

                let currentQty = parseInt($qtyTarget.text()) || 0;

                if (action === 'minus' && currentQty > 1) {
                    $qtyTarget.text(currentQty - 1);
                } else if (action === 'plus') {
                    $qtyTarget.text(currentQty + 1);
                }

                updateCartSummary(); // Hitung ulang harga jika kuantitas berubah
            });

            // --- 3. EVENT: Checkbox "Pilih Semua" ---
            $(document).on('change', '#selectAll', function() {
                let isChecked = $(this).is(':checked');
                $('.item-checkbox').prop('checked', isChecked);
                updateCartSummary();
            });

            // --- 4. EVENT: Checkbox Per Item ---
            $(document).on('change', '.item-checkbox', function() {
                updateCartSummary();
            });

            // --- 5. EVENT: Tombol Hapus Terpilih ---
            $(document).on('click', '#btn-delete-selected', function() {
                $('.item-checkbox:checked').each(function() {
                    $(this).closest('article').remove();
                });
                updateCartSummary();
            });

            // Jalankan sekali saat halaman pertama kali dimuat
            updateCartSummary();
        });
    </script>
@endpush
