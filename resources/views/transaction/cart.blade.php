@extends('layout')

@section('content')
    <main class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin-desktop py-8 space-y-6">
        <h1 class="text-2xl font-extrabold text-slate-800">Keranjang Belanja</h1>
        
        <!-- Alerts -->
        @if(session('success'))
            <div class="flex items-center gap-3 p-4 bg-emerald-50 text-emerald-800 rounded-xl border border-emerald-100 text-sm">
                <span class="material-symbols-outlined text-[20px] text-emerald-600">check_circle</span>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="flex items-center gap-3 p-4 bg-rose-50 text-rose-800 rounded-xl border border-rose-100 text-sm">
                <span class="material-symbols-outlined text-[20px] text-rose-600">error</span>
                <span class="font-semibold">{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- LEFT COLUMN: Cart Items (Col Span 8) -->
            <section class="lg:col-span-8 space-y-4" data-purpose="cart-items-container">
                <!-- Selection Controller -->
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <input checked id="selectAll" class="w-5 h-5 rounded border-slate-300 text-primary focus:ring-primary cursor-pointer" type="checkbox" />
                        <label class="font-bold text-slate-700 text-sm select-none cursor-pointer" for="selectAll" id="select-all-label">Pilih Semua ({{ count($cartItems) }})</label>
                    </div>
                </div>

                <!-- Store Items List -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden divide-y divide-slate-100">
                    @forelse($cartItems as $item)
                        <!-- Cart Item -->
                        <article class="p-5 flex flex-col sm:flex-row gap-4" data-purpose="cart-item">
                            <div class="flex items-start gap-3">
                                <input checked class="mt-2 w-5 h-5 rounded border-slate-300 text-primary focus:ring-primary item-checkbox cursor-pointer" type="checkbox" data-id="{{ $item['product']->id }}" />
                                
                                <div class="relative w-20 h-20 flex-shrink-0 bg-slate-50 rounded-xl overflow-hidden border border-slate-100">
                                    @if(Str::startsWith($item['product']->image, 'http'))
                                        <img alt="{{ $item['product']->name }}" class="w-full h-full object-cover" src="{{ $item['product']->image }}" />
                                    @else
                                        <img alt="{{ $item['product']->name }}" class="w-full h-full object-cover" src="{{ asset($item['product']->image) }}" />
                                    @endif
                                </div>
                            </div>

                            <div class="flex-grow flex flex-col justify-between">
                                <div class="flex justify-between items-start gap-4">
                                    <div class="min-w-0">
                                        <h3 class="font-bold text-slate-800 text-sm hover:text-primary transition-colors truncate">
                                            <a href="{{ route('product.show', $item['product']->slug) }}">
                                                {{ $item['product']->name }}
                                            </a>
                                        </h3>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-[10px] bg-slate-100 text-slate-500 font-bold px-2 py-0.5 rounded border border-slate-100 uppercase">
                                                {{ $item['product']->category->name }}
                                            </span>
                                            @if($item['product']->target_animals)
                                                <span class="text-[10px] text-slate-400 font-semibold">Spesies: {{ $item['product']->target_animals }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-right whitespace-nowrap">
                                        <span class="block font-extrabold text-base text-slate-800 item-price" data-price="{{ $item['product']->price }}">Rp {{ number_format($item['product']->price, 0, ',', '.') }}</span>
                                        <span class="text-[10px] text-slate-400 mt-1 block">Stok: {{ $item['product']->stock }} unit</span>
                                    </div>
                                </div>

                                <!-- Item Actions & Quantity Controls -->
                                <div class="flex items-center justify-between mt-4">
                                    <!-- Delete Item Button -->
                                    <form action="{{ route('cart.delete') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item['product']->id }}" />
                                        <button type="submit" class="text-slate-400 hover:text-rose-600 p-1.5 hover:bg-rose-50 rounded-xl transition-all" title="Hapus dari keranjang">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </form>
                                    
                                    <!-- Quantity Picker with Limits -->
                                    <div class="flex items-center border border-slate-200 rounded-xl h-9 px-2 bg-slate-50/50 justify-between w-28">
                                        <button class="w-7 h-7 rounded-lg hover:bg-slate-200 font-extrabold flex items-center justify-center text-slate-500 transition-colors btn-qty" data-action="minus" data-id="{{ $item['product']->id }}">-</button>
                                        <span class="text-xs font-bold w-6 text-center text-slate-800 qty-val" data-id="{{ $item['product']->id }}" data-stock="{{ $item['product']->stock }}">{{ $item['quantity'] }}</span>
                                        <button class="w-7 h-7 rounded-lg hover:bg-slate-200 font-extrabold flex items-center justify-center text-slate-500 transition-colors btn-qty" data-action="plus" data-id="{{ $item['product']->id }}">+</button>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="p-12 text-center text-slate-400 dark:text-slate-500">
                            <span class="material-symbols-outlined text-[48px] text-slate-300 mb-3">shopping_cart</span>
                            <p class="font-bold text-sm text-slate-800">Keranjang belanja Anda kosong.</p>
                            <p class="text-xs mt-1 mb-4">Ayo cari obat atau kebutuhan hewan piaraan Anda sekarang!</p>
                            <a href="{{ route('home') }}" class="inline-block bg-primary text-white font-bold px-6 py-2.5 rounded-xl text-xs hover:bg-primary/95 transition-all shadow-sm active:scale-95">
                                Belanja Sekarang
                            </a>
                        </div>
                    @endforelse
                </div>
            </section>

            <!-- RIGHT COLUMN: Summary Card (Col Span 4) -->
            <aside class="lg:col-span-4">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 sticky top-24" data-purpose="order-summary-card">
                    <h2 class="font-bold text-slate-800 text-base mb-4 border-b border-slate-50 pb-3">Ringkasan Belanja</h2>
                    
                    <div class="flex justify-between items-center mb-6 text-sm">
                        <span class="text-slate-500 font-medium">Total Harga</span>
                        <span class="text-xl font-extrabold text-primary" id="total-price">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                    </div>

                    <!-- Checkout Redirect Action -->
                    @if(count($cartItems) > 0)
                        <button id="btn-buy" onclick="window.location.href='{{ route('checkout.index') }}'"
                            class="w-full bg-primary text-white font-bold py-3 rounded-xl hover:bg-primary/95 transition-colors shadow-md flex items-center justify-center gap-2 text-sm active:scale-[0.98]">
                            <span class="material-symbols-outlined text-[18px]">shopping_cart_checkout</span>
                            Beli ({{ count($cartItems) }})
                        </button>
                    @else
                        <button disabled class="w-full bg-slate-100 text-slate-400 font-bold py-3 rounded-xl cursor-not-allowed text-sm">
                            Beli (0)
                        </button>
                    @endif

                    <div class="mt-4 flex items-center justify-center gap-1.5 text-[10px] text-slate-400 font-semibold">
                        <span class="material-symbols-outlined text-[14px]">lock</span>
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
            // --- 1. UTILITY: Recalculate Cart Summary ---
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

                // Update Total Price display
                $('#total-price').text('Rp ' + totalHarga.toLocaleString('id-ID'));

                // Update Buy Button label
                $('#select-all-label').text('Pilih Semua (' + totalItems + ')');
                if (selectedCount > 0) {
                    $('#btn-buy').html('<span class="material-symbols-outlined text-[18px]">shopping_cart_checkout</span> Beli (' + selectedCount + ')').prop('disabled', false).removeClass('bg-slate-100 text-slate-400 cursor-not-allowed').addClass('bg-primary text-white');
                } else {
                    $('#btn-buy').html('Beli (0)').prop('disabled', true).addClass('bg-slate-100 text-slate-400 cursor-not-allowed').removeClass('bg-primary text-white');
                }

                // Master Checkbox State sync
                $('#selectAll').prop('checked', selectedCount === totalItems && totalItems > 0);
                
                // Disable/Enable Plus and Minus buttons per item
                $('.qty-val').each(function() {
                    let id = $(this).data('id');
                    let qty = parseInt($(this).text()) || 1;
                    let stock = parseInt($(this).data('stock')) || 0;
                    
                    let $btnMinus = $('.btn-qty[data-action="minus"][data-id="' + id + '"]');
                    let $btnPlus = $('.btn-qty[data-action="plus"][data-id="' + id + '"]');
                    
                    // Enable/disable minus
                    $btnMinus.prop('disabled', qty <= 1).toggleClass('opacity-30 cursor-not-allowed', qty <= 1);
                    // Enable/disable plus
                    $btnPlus.prop('disabled', qty >= stock).toggleClass('opacity-30 cursor-not-allowed', qty >= stock);
                });
            }

            // --- 2. EVENT: Quantity Plus / Minus Controls with Stock Checks ---
            $(document).on('click', '.btn-qty', function(e) {
                e.preventDefault();
                let $btn = $(this);
                let id = $btn.data('id');
                let action = $btn.data('action');
                let $qtyTarget = $('.qty-val[data-id="' + id + '"]');

                let currentQty = parseInt($qtyTarget.text()) || 1;
                let maxStock = parseInt($qtyTarget.data('stock')) || 0;
                let newQty = currentQty;

                if (action === 'minus' && currentQty > 1) {
                    newQty = currentQty - 1;
                } else if (action === 'plus') {
                    if (currentQty >= maxStock) {
                        alert('Kuantitas tidak dapat melebihi stok yang tersedia (' + maxStock + ' unit).');
                        return;
                    }
                    newQty = currentQty + 1;
                }

                if (newQty !== currentQty) {
                    $qtyTarget.text(newQty);
                    
                    // Sync quantity with backend Laravel session
                    $.post('{{ route("cart.update") }}', {
                        _token: '{{ csrf_token() }}',
                        product_id: id,
                        quantity: newQty
                    }).fail(function(xhr) {
                        // Revert quantity if backend rejects
                        $qtyTarget.text(currentQty);
                        alert(xhr.responseJSON.message || 'Gagal mengubah kuantitas.');
                        updateCartSummary();
                    });
                }

                updateCartSummary();
            });

            // --- 3. EVENT: Master Checkbox "Pilih Semua" ---
            $(document).on('change', '#selectAll', function() {
                let isChecked = $(this).is(':checked');
                $('.item-checkbox').prop('checked', isChecked);
                updateCartSummary();
            });

            // --- 4. EVENT: Item Checkbox Trigger ---
            $(document).on('change', '.item-checkbox', function() {
                updateCartSummary();
            });

            // Run once on initial page load
            updateCartSummary();
        });
    </script>
@endpush
