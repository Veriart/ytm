@extends('layout')

@section('content')
    <main class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Keranjang Belanja</h1>
        
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6 text-sm font-semibold shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6 text-sm font-semibold shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- LEFT COLUMN: Cart Items -->
            <section class="lg:col-span-2 space-y-4" data-purpose="cart-items-container">
                <!-- Selection Controller -->
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <input checked="" id="selectAll" class="w-5 h-5 rounded text-primary focus:ring-primary" type="checkbox" />
                        <label class="font-medium" for="selectAll" id="select-all-label">Pilih Semua ({{ count($cartItems) }})</label>
                    </div>
                </div>
                <!-- Store Header -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    @forelse($cartItems as $item)
                        <!-- Cart Item -->
                        <article class="p-4 flex flex-col md:flex-row border-b border-gray-100 last:border-0" data-purpose="cart-item">
                            <div class="flex items-start space-x-3">
                                <input checked="" class="mt-2 w-5 h-5 rounded text-primary focus:ring-primary item-checkbox" type="checkbox" data-id="{{ $item['product']->id }}" />
                                <div class="relative w-24 h-24 flex-shrink-0">
                                    @if(Str::startsWith($item['product']->image, 'http'))
                                        <img alt="{{ $item['product']->name }}" class="w-full h-full object-cover rounded-lg border" src="{{ $item['product']->image }}" />
                                    @else
                                        <img alt="{{ $item['product']->name }}" class="w-full h-full object-cover rounded-lg border" src="{{ asset($item['product']->image) }}" />
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 mt-4 md:mt-0 md:ml-4">
                                <div class="flex justify-between">
                                    <div>
                                        <h3 class="font-medium text-gray-900 leading-tight">
                                            <a href="{{ route('product.show', $item['product']->slug) }}" class="hover:text-primary transition-colors">
                                                {{ $item['product']->name }}
                                            </a>
                                        </h3>
                                        <p class="text-sm text-gray-500 mt-1">Kategori: {{ $item['product']->category->name }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="block font-bold text-lg item-price" data-price="{{ $item['product']->price }}">Rp{{ number_format($item['product']->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                <!-- Item Actions -->
                                <div class="flex items-center justify-end mt-4 space-x-4">
                                    <!-- Delete Form -->
                                    <form action="{{ route('cart.delete') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item['product']->id }}" />
                                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                                                <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                            </svg>
                                        </button>
                                    </form>
                                    
                                    <div class="flex items-center border rounded-lg h-8 px-2 space-x-4">
                                        <button class="text-primary font-bold btn-qty" data-action="minus" data-id="{{ $item['product']->id }}">-</button>
                                        <span class="text-sm font-medium w-4 text-center qty-val" data-id="{{ $item['product']->id }}">{{ $item['quantity'] }}</span>
                                        <button class="text-primary font-bold btn-qty" data-action="plus" data-id="{{ $item['product']->id }}">+</button>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="p-8 text-center text-muted">
                            Keranjang belanja Anda kosong. <a href="{{ route('home') }}" class="text-primary font-bold hover:underline">Belanja Sekarang</a>.
                        </div>
                    @endforelse
                </div>
            </section>
            <!-- RIGHT COLUMN: Summary Card -->
            <aside class="lg:col-span-1">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-28" data-purpose="order-summary-card">
                    <h2 class="font-bold text-lg mb-6">Ringkasan belanja</h2>
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-gray-600">Total</span>
                        <span class="text-xl font-bold text-primary" id="total-price">Rp{{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>
                    <!-- Buy Button -->
                    @if(count($cartItems) > 0)
                        <button id="btn-buy" onclick="window.location.href='{{ route('checkout.index') }}'"
                            class="w-full bg-primary text-white font-bold py-3 rounded-xl hover:bg-primary/95 transition-colors shadow-md">
                            Beli ({{ count($cartItems) }})
                        </button>
                    @else
                        <button disabled class="w-full bg-gray-300 text-gray-500 font-bold py-3 rounded-xl cursor-not-allowed">
                            Beli (0)
                        </button>
                    @endif
                    <!-- Disclaimer -->
                    <div class="mt-4 flex items-center justify-center space-x-2 text-xs text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewbox="0 0 24 24">
                            <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
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

                        let price = parseInt($article.find('.item-price').data('price')) || 0;
                        let qty = parseInt($article.find('.qty-val').text()) || 0;

                        totalHarga += (price * qty);
                    }
                });

                // Update Total Harga
                $('#total-price').text('Rp' + totalHarga.toLocaleString('id-ID'));

                // Update Beli Button
                $('#select-all-label').text('Pilih Semua (' + totalItems + ')');
                if (selectedCount > 0) {
                    $('#btn-buy').text('Beli (' + selectedCount + ')').prop('disabled', false).removeClass('bg-gray-300 text-gray-500 cursor-not-allowed').addClass('bg-primary text-white');
                } else {
                    $('#btn-buy').text('Beli (0)').prop('disabled', true).addClass('bg-gray-300 text-gray-500 cursor-not-allowed').removeClass('bg-primary text-white');
                }

                // Master Checkbox State
                $('#selectAll').prop('checked', selectedCount === totalItems && totalItems > 0);
            }

            // --- 2. EVENT: Kuantitas Plus / Minus ---
            $(document).on('click', '.btn-qty', function() {
                let $btn = $(this);
                let id = $btn.data('id');
                let action = $btn.data('action');
                let $qtyTarget = $('.qty-val[data-id="' + id + '"]');

                let currentQty = parseInt($qtyTarget.text()) || 1;
                let newQty = currentQty;

                if (action === 'minus' && currentQty > 1) {
                    newQty = currentQty - 1;
                } else if (action === 'plus') {
                    newQty = currentQty + 1;
                }

                if (newQty !== currentQty) {
                    $qtyTarget.text(newQty);
                    
                    // Sync quantity with backend session
                    $.post('{{ route("cart.update") }}', {
                        _token: '{{ csrf_token() }}',
                        product_id: id,
                        quantity: newQty
                    }).fail(function(xhr) {
                        // revert
                        $qtyTarget.text(currentQty);
                        alert(xhr.responseJSON.message || 'Gagal mengubah kuantitas.');
                        updateCartSummary();
                    });
                }

                updateCartSummary();
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

            // Run once on load
            updateCartSummary();
        });
    </script>
@endpush
