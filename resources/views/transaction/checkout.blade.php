@extends('layout')

@section('content')
    <main class="w-full min-h-screen bg-slate-50/50 pb-16">
        <div class="flex flex-col w-full">
            <!-- Dynamic Progress Indicator (Steps) -->
            <div class="w-full bg-white px-margin-mobile md:px-margin-desktop py-4 mb-8 border-b border-slate-100 shadow-sm">
                <div class="max-w-[1280px] mx-auto flex items-center gap-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-primary/10 text-primary flex items-center justify-center text-xs font-extrabold">1</span>
                        <span class="text-xs font-bold text-primary">Keranjang</span>
                    </div>
                    <div class="h-[2px] w-12 bg-primary/20"></div>
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center text-xs font-extrabold">2</span>
                        <span class="text-xs font-bold text-primary">Pengiriman &amp; Checkout</span>
                    </div>
                    <div class="h-[2px] w-12 bg-slate-200"></div>
                    <div class="flex items-center gap-2 opacity-50">
                        <span class="w-6 h-6 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center text-xs font-extrabold">3</span>
                        <span class="text-xs font-bold text-slate-500">Konfirmasi Transaksi</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form" class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin-desktop w-full grid grid-cols-1 lg:grid-cols-12 gap-8">
                @csrf
                
                <!-- Hidden Calculation Inputs -->
                <input type="hidden" name="delivery_option" id="input-delivery-option" value="shipping" />
                <input type="hidden" name="payment_mode" id="input-payment-mode" value="transfer" />
                <input type="hidden" name="shipping_cost" id="input-shipping-cost" value="{{ $shippingMethods->first()->cost ?? 0 }}" />
                <input type="hidden" name="discount" id="input-discount" value="0" />
                <input type="hidden" name="service_fee" id="input-service-fee" value="2000" />

                <!-- Left Column: Shipping & Order list (Col Span 8) -->
                <div class="lg:col-span-8 space-y-8">
                    <!-- Section: Opsi Pengiriman -->
                    <section class="space-y-4">
                        <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">local_shipping</span>
                            Pilih Metode Penerimaan Barang
                        </h2>
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Option 1: Kirim Kurir -->
                            <label class="p-4 bg-white rounded-xl text-left border-2 border-primary ring-2 ring-primary/10 cursor-pointer delivery-opt-btn block transition-all" data-value="shipping">
                                <div class="flex items-center gap-3 mb-1">
                                    <input type="radio" name="delivery_option_radio" value="shipping" checked class="w-4 h-4 text-primary focus:ring-primary delivery-opt-radio cursor-pointer" />
                                    <span class="font-bold text-slate-800 text-sm flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-[18px] text-primary">local_shipping</span>
                                        Kirim ke Alamat (Kurir)
                                    </span>
                                </div>
                                <p class="text-xs text-slate-400 pl-7">Pesanan Anda akan dikirim ke alamat tujuan dengan jasa ekspedisi pilihan.</p>
                            </label>
                            
                            <!-- Option 2: Ambil di Toko -->
                            <label class="p-4 bg-white rounded-xl text-left border border-slate-200 hover:border-primary cursor-pointer delivery-opt-btn block transition-all" data-value="pickup">
                                <div class="flex items-center gap-3 mb-1">
                                    <input type="radio" name="delivery_option_radio" value="pickup" class="w-4 h-4 text-primary focus:ring-primary delivery-opt-radio cursor-pointer" />
                                    <span class="font-bold text-slate-800 text-sm flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-[18px] text-primary">store</span>
                                        Ambil di Toko Utama (YTM)
                                    </span>
                                </div>
                                <p class="text-xs text-slate-400 pl-7">Ambil pesanan secara langsung di toko utama kami tanpa biaya pengiriman.</p>
                            </label>
                        </div>
                    </section>

                    <!-- Section: Delivery Address -->
                    <section id="shipping-address-section" class="space-y-4">
                        <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">location_on</span>
                            Informasi Alamat Pengiriman
                        </h2>
                        
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 space-y-4">
                            <div>
                                <label class="font-bold text-xs text-slate-400 uppercase tracking-wider block mb-1.5">Nama Penerima</label>
                                <input type="text" class="w-full bg-slate-100 text-slate-500 text-sm py-2.5 px-3 rounded-xl border border-slate-200 cursor-not-allowed" value="{{ $user->name }}" disabled />
                            </div>

                            <div>
                                <label class="font-bold text-xs text-slate-400 uppercase tracking-wider block mb-1.5">Nomor Telepon Penerima <span class="text-rose-500">*</span></label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" required placeholder="Contoh: 081234567890" class="w-full bg-slate-50 text-sm py-2.5 px-3 rounded-xl border {{ $errors->has('phone') ? 'border-rose-500 focus:ring-rose-500' : 'border-slate-200 focus:ring-primary' }} focus:outline-none focus:ring-2 focus:border-transparent transition-all" />
                                @error('phone')
                                    <span class="text-rose-500 text-xs mt-1 block font-semibold">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="font-bold text-xs text-slate-400 uppercase tracking-wider block mb-1.5">Alamat Lengkap Pengiriman <span class="text-rose-500">*</span></label>
                                <textarea name="shipping_address" id="shipping_address" rows="3" required placeholder="Tuliskan alamat lengkap pengiriman secara detail (jalan, nomor rumah, kelurahan, kecamatan, kota/kabupaten, dan kode pos)..." class="w-full bg-slate-50 text-sm py-2.5 px-3 rounded-xl border {{ $errors->has('shipping_address') ? 'border-rose-500 focus:ring-rose-500' : 'border-slate-200 focus:ring-primary' }} focus:outline-none focus:ring-2 focus:border-transparent transition-all">{{ old('shipping_address', $user->address) }}</textarea>
                                @error('shipping_address')
                                    <span class="text-rose-500 text-xs mt-1 block font-semibold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </section>

                    <!-- Section: Order List -->
                    <section class="space-y-4">
                        <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">medication</span>
                            Daftar Obat &amp; Peralatan Medis Pesanan
                        </h2>
                        <!-- Cart Items Container -->
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden divide-y divide-slate-100">
                            @foreach($cartItems as $item)
                                <div class="p-5 flex gap-4 group">
                                    <div class="w-16 h-16 rounded-xl bg-slate-50 border border-slate-100 overflow-hidden flex-shrink-0">
                                        @if(Str::startsWith($item['product']->image, 'http'))
                                            <img class="w-full h-full object-cover" src="{{ $item['product']->image }}" alt="{{ $item['product']->name }}" />
                                        @else
                                            <img class="w-full h-full object-cover" src="{{ asset($item['product']->image) }}" alt="{{ $item['product']->name }}" />
                                        @endif
                                    </div>
                                    <div class="flex-grow flex flex-col justify-between">
                                        <div class="flex justify-between items-start gap-4">
                                            <div>
                                                <h3 class="font-bold text-slate-800 text-sm">{{ $item['product']->name }}</h3>
                                                <p class="text-xs text-slate-400 mt-1">Kategori: {{ $item['product']->category->name }}</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-extrabold text-sm text-primary">Rp {{ number_format($item['product']->price, 0, ',', '.') }}</p>
                                                <p class="text-xs text-slate-400 mt-0.5">{{ $item['quantity'] }} unit</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- Courier Selection -->
                    <section id="courier-section" class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                        <h3 class="font-bold text-slate-800 text-sm flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[20px]">local_shipping</span>
                            Pilih Jasa Ekspedisi Pengiriman
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse($shippingMethods as $idx => $sm)
                                <label class="p-4 bg-white rounded-xl text-left border {{ $idx === 0 ? 'border-2 border-primary ring-2 ring-primary/10' : 'border-slate-200 hover:border-primary' }} cursor-pointer courier-btn block transition-all" data-cost="{{ $sm->cost }}">
                                    <div class="flex justify-between items-center mb-1">
                                        <div class="flex items-center gap-2">
                                            <input type="radio" name="courier" value="{{ $sm->name }}" {{ $idx === 0 ? 'checked' : '' }} class="w-4 h-4 text-primary focus:ring-primary courier-radio cursor-pointer" />
                                            <span class="font-bold text-slate-800 text-sm">{{ $sm->name }}</span>
                                        </div>
                                        <span class="text-sm text-primary font-extrabold">Rp {{ number_format($sm->cost, 0, ',', '.') }}</span>
                                    </div>
                                    @if($sm->description)
                                        <p class="text-xs text-slate-400 pl-6">{{ $sm->description }}</p>
                                    @endif
                                </label>
                            @empty
                                <div class="col-span-2 text-center py-4 bg-slate-50 border border-slate-100 rounded-xl">
                                    <p class="text-xs text-slate-400 italic font-semibold">Tidak ada metode pengiriman ekspedisi yang tersedia.</p>
                                </div>
                            @endforelse
                        </div>
                    </section>
                </div>

                <!-- Right Column: Sticky Summary & Payment Method (Col Span 4) -->
                <div class="lg:col-span-4">
                    <div class="sticky top-24 space-y-6">
                        <!-- Payment Method Info -->
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 space-y-4">
                            <h3 class="font-bold text-slate-800 text-xs uppercase tracking-wider border-b border-slate-50 pb-2">Metode Pembayaran</h3>
                            
                            <!-- Pickup Payment Options Selector (Only shown when pickup is active) -->
                            <div id="pickup-payment-selector" class="hidden space-y-2 mb-4">
                                <label class="flex items-center justify-between p-3 rounded-xl border-2 border-primary ring-2 ring-primary/10 cursor-pointer pickup-pm-btn transition-all" data-value="transfer">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" name="pickup_payment_radio" value="transfer" checked class="w-4 h-4 text-primary focus:ring-primary pickup-pm-radio cursor-pointer" />
                                        <span class="text-sm text-slate-700 font-bold">Transfer (Midtrans)</span>
                                    </div>
                                </label>
                                
                                <label class="flex items-center justify-between p-3 rounded-xl border border-slate-200 hover:border-primary cursor-pointer pickup-pm-btn transition-all" data-value="cash">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" name="pickup_payment_radio" value="cash" class="w-4 h-4 text-primary focus:ring-primary pickup-pm-radio cursor-pointer" />
                                        <span class="text-sm text-slate-700 font-bold">Bayar Cash di Kasir</span>
                                    </div>
                                </label>
                            </div>

                            <!-- Midtrans Info Box -->
                            <div id="midtrans-info-box" class="p-4 bg-slate-50 rounded-xl border border-slate-100 flex flex-col gap-3">
                                <div class="flex items-center gap-2 text-primary font-bold text-sm">
                                    <span class="material-symbols-outlined text-[18px]">security</span>
                                    <span>Midtrans Payment Gateway</span>
                                </div>
                                <p class="text-slate-500 text-[11px] font-semibold leading-relaxed">
                                    Setelah menekan tombol "Bayar Sekarang", Anda akan diarahkan ke halaman pembayaran Midtrans untuk menyelesaikan pembayaran secara aman via:
                                </p>
                                <div class="grid grid-cols-3 gap-2 items-center opacity-80 mt-1">
                                    <div class="px-2 py-1 bg-white border border-slate-200 rounded text-center text-[9px] font-bold text-slate-600">Virtual Account</div>
                                    <div class="px-2 py-1 bg-white border border-slate-200 rounded text-center text-[9px] font-bold text-slate-600">GoPay / QRIS</div>
                                    <div class="px-2 py-1 bg-white border border-slate-200 rounded text-center text-[9px] font-bold text-slate-600">Kartu Kredit</div>
                                </div>
                            </div>

                            <!-- Cash Info Box -->
                            <div id="cash-info-box" class="hidden p-4 bg-emerald-50 text-emerald-850 rounded-xl border border-emerald-100 flex flex-col gap-2">
                                <div class="flex items-center gap-2 text-emerald-700 font-bold text-sm">
                                    <span class="material-symbols-outlined text-[18px]">payments</span>
                                    <span>Bayar Tunai di Kasir</span>
                                </div>
                                <p class="text-[11px] font-semibold leading-relaxed text-emerald-600">
                                    Pesanan Anda akan langsung diproses. Silakan tunjukkan nomor invoice pesanan Anda ke kasir YTM saat melakukan pengambilan barang untuk melakukan pembayaran cash secara langsung di kasir toko.
                                </p>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 space-y-4">
                            <h3 class="font-bold text-slate-800 text-xs uppercase tracking-wider border-b border-slate-50 pb-2">Rincian Transaksi</h3>
                            <div class="space-y-2 text-xs font-semibold text-slate-500">
                                <div class="flex justify-between">
                                    <span>Total Harga ({{ array_sum(session('cart', [])) }} Barang)</span>
                                    <span id="txt-subtotal" class="text-slate-800" data-value="{{ $totalPrice }}">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Total Ongkos Kirim</span>
                                    <span id="txt-shipping-cost" class="text-slate-800">Rp {{ number_format($shippingMethods->first()->cost ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Biaya Jasa Layanan</span>
                                    <span class="text-slate-800">Rp 2.000</span>
                                </div>
                                <div class="flex justify-between text-emerald-600 font-bold">
                                    <span>Diskon Promo</span>
                                    <span>-Rp 0</span>
                                </div>
                            </div>
                            
                            <div class="pt-4 border-t border-dashed border-slate-100 flex justify-between items-center">
                                <span class="font-bold text-slate-800 text-sm">Total Tagihan</span>
                                <span class="font-extrabold text-primary text-xl" id="txt-grandtotal">Rp {{ number_format($totalPrice + ($shippingMethods->first()->cost ?? 0) + 2000, 0, ',', '.') }}</span>
                            </div>
                            
                            <button type="submit" id="btn-submit-checkout" class="w-full bg-primary text-white py-3 rounded-xl font-bold text-sm hover:bg-primary/95 active:scale-98 transition-all shadow-md flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">payments</span>
                                Bayar Sekarang
                            </button>
                            
                            <div class="pt-2 flex items-center justify-center gap-1.5 text-[10px] text-slate-400 font-semibold border-t border-slate-50">
                                <span class="material-symbols-outlined text-[14px]">security</span>
                                <span>Distribusi Cold Chain Obat Veteriner Terjamin</span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Update Shipping Courier Selection and Recalculate Totals
            const courierButtons = document.querySelectorAll('.courier-btn');
            
            courierButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Reset all courier buttons borders
                    courierButtons.forEach(b => {
                        b.classList.remove('border-2', 'border-primary', 'ring-2', 'ring-primary/10');
                        b.classList.add('border', 'border-slate-200');
                        b.querySelector('.courier-radio').checked = false;
                    });
                    
                    // Set current clicked button active
                    this.classList.remove('border', 'border-slate-200');
                    this.classList.add('border-2', 'border-primary', 'ring-2', 'ring-primary/10');
                    
                    // Check internal radio button
                    const radio = this.querySelector('.courier-radio');
                    radio.checked = true;
                    
                    // Update shipping values and totals
                    const cost = parseInt(this.getAttribute('data-cost')) || 0;
                    document.getElementById('input-shipping-cost').value = cost;
                    document.getElementById('txt-shipping-cost').textContent = 'Rp ' + cost.toLocaleString('id-ID');
                    
                    recalculateTotals();
                });
            });
            // Update Delivery Option selection
            const deliveryOptButtons = document.querySelectorAll('.delivery-opt-btn');
            const shippingAddressSection = document.getElementById('shipping-address-section');
            const courierSection = document.getElementById('courier-section');
            const shippingAddressInput = document.getElementById('shipping_address');
            
            // Pickup payment controls
            const pickupPmSelector = document.getElementById('pickup-payment-selector');
            const pickupPmButtons = document.querySelectorAll('.pickup-pm-btn');
            const midtransInfoBox = document.getElementById('midtrans-info-box');
            const cashInfoBox = document.getElementById('cash-info-box');
            
            deliveryOptButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Reset all delivery options borders
                    deliveryOptButtons.forEach(b => {
                        b.classList.remove('border-2', 'border-primary', 'ring-2', 'ring-primary/10');
                        b.classList.add('border', 'border-slate-200');
                        b.querySelector('.delivery-opt-radio').checked = false;
                    });
                    
                    // Set current clicked button active
                    this.classList.remove('border', 'border-slate-200');
                    this.classList.add('border-2', 'border-primary', 'ring-2', 'ring-primary/10');
                    
                    // Check internal radio button
                    const radio = this.querySelector('.delivery-opt-radio');
                    radio.checked = true;
                    
                    const value = this.getAttribute('data-value');
                    document.getElementById('input-delivery-option').value = value;
                    
                    if (value === 'pickup') {
                        // Hide courier & address
                        shippingAddressSection.classList.add('hidden');
                        courierSection.classList.add('hidden');
                        
                        // Disable requirements
                        shippingAddressInput.required = false;
                        
                        // Update shipping cost in calculation
                        document.getElementById('input-shipping-cost').value = 0;
                        document.getElementById('txt-shipping-cost').textContent = 'Rp 0';
                        
                        // Show pickup payment selector
                        pickupPmSelector.classList.remove('hidden');
                        
                        // Sync visual and input based on checked radio button
                        const activePmBtn = document.querySelector('.pickup-pm-btn.border-primary');
                        const pmValue = activePmBtn ? activePmBtn.getAttribute('data-value') : 'transfer';
                        document.getElementById('input-payment-mode').value = pmValue;
                        
                        if (pmValue === 'cash') {
                            midtransInfoBox.classList.add('hidden');
                            cashInfoBox.classList.remove('hidden');
                        } else {
                            midtransInfoBox.classList.remove('hidden');
                            cashInfoBox.classList.add('hidden');
                        }
                    } else {
                        // Show courier & address
                        shippingAddressSection.classList.remove('hidden');
                        courierSection.classList.remove('hidden');
                        
                        // Enable requirements
                        shippingAddressInput.required = true;
                        
                        // Restore shipping cost based on selected courier
                        const activeCourierBtn = document.querySelector('.courier-btn.border-primary');
                        const cost = activeCourierBtn ? parseInt(activeCourierBtn.getAttribute('data-cost')) : {{ $shippingMethods->first()->cost ?? 0 }};
                        document.getElementById('input-shipping-cost').value = cost;
                        document.getElementById('txt-shipping-cost').textContent = 'Rp ' + cost.toLocaleString('id-ID');
                        
                        // Hide pickup payment selector & reset payment mode to transfer
                        pickupPmSelector.classList.add('hidden');
                        document.getElementById('input-payment-mode').value = 'transfer';
                        midtransInfoBox.classList.remove('hidden');
                        cashInfoBox.classList.add('hidden');
                    }
                    
                    recalculateTotals();
                });
            });

            // Update Pickup Payment Mode selection
            pickupPmButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Reset all pickup payment buttons borders
                    pickupPmButtons.forEach(b => {
                        b.classList.remove('border-2', 'border-primary', 'ring-2', 'ring-primary/10');
                        b.classList.add('border-slate-200');
                        b.querySelector('.pickup-pm-radio').checked = false;
                    });
                    
                    // Set current clicked button active
                    this.classList.remove('border-slate-200');
                    this.classList.add('border-2', 'border-primary', 'ring-2', 'ring-primary/10');
                    
                    // Check internal radio button
                    const radio = this.querySelector('.pickup-pm-radio');
                    radio.checked = true;
                    
                    const value = this.getAttribute('data-value');
                    document.getElementById('input-payment-mode').value = value;
                    
                    if (value === 'cash') {
                        midtransInfoBox.classList.add('hidden');
                        cashInfoBox.classList.remove('hidden');
                    } else {
                        midtransInfoBox.classList.remove('hidden');
                        cashInfoBox.classList.add('hidden');
                    }
                });
            });
            // Recalculate Total Bills
            function recalculateTotals() {
                const subtotal = parseInt(document.getElementById('txt-subtotal').getAttribute('data-value')) || 0;
                const shipping = parseInt(document.getElementById('input-shipping-cost').value) || 0;
                const service = parseInt(document.getElementById('input-service-fee').value) || 0;
                const discount = parseInt(document.getElementById('input-discount').value) || 0;
                
                const grandTotal = subtotal + shipping + service - discount;
                document.getElementById('txt-grandtotal').textContent = 'Rp ' + grandTotal.toLocaleString('id-ID');
            }

            // Spinner effect when submit button is pressed
            const form = document.getElementById('checkout-form');
            const submitBtn = document.getElementById('btn-submit-checkout');
            
            form.addEventListener('submit', function() {
                submitBtn.innerHTML = '<span class="animate-spin material-symbols-outlined align-middle text-[18px]">sync</span> Memproses Pembayaran...';
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            });
        });
    </script>
@endpush
