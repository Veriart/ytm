@extends('layout')
@section('content')
    <main class="w-full pt-8 bg-surface mb-5 min-h-screen">
        <div class="flex flex-col w-full">
            <!-- Dynamic Progress Indicator -->
            <div class="w-full bg-surface-container-low px-margin-mobile md:px-margin-desktop py-base mb-md">
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
            <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form" class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin-desktop w-full grid grid-cols-1 lg:grid-cols-12 gap-xl">
                @csrf
                
                <!-- Hidden Calculation Inputs -->
                <input type="hidden" name="shipping_cost" id="input-shipping-cost" value="15000" />
                <input type="hidden" name="discount" id="input-discount" value="0" />
                <input type="hidden" name="service_fee" id="input-service-fee" value="2000" />
                <input type="hidden" name="payment_method" id="input-payment-method" value="BCA Virtual Account" />

                <!-- Left Column: Order Details -->
                <div class="lg:col-span-8 space-y-lg">
                    <!-- Section: Delivery Address -->
                    <section class="space-y-md">
                        <h2 class="font-headline-md text-on-surface flex items-center gap-xs">
                            <span class="material-symbols-outlined text-primary">location_on</span>
                            Informasi Pengiriman
                        </h2>
                        
                        <div class="bg-white p-md rounded-xl shadow-sm border border-outline-variant space-y-4">
                            <div>
                                <label class="font-semibold text-sm text-gray-700 block mb-1">Nama Penerima</label>
                                <input type="text" class="w-full bg-surface-container-low text-body-md py-2 px-3 rounded-lg border border-outline-variant cursor-not-allowed" value="{{ $user->name }}" disabled />
                            </div>

                            <div>
                                <label class="font-semibold text-sm text-gray-700 block mb-1">Nomor Telepon Penerima *</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required placeholder="Contoh: 081234567890" class="w-full bg-surface-container-low text-body-md py-2 px-3 rounded-lg border border-outline-variant focus:border-primary outline-none transition-all @error('phone') border-red-500 @enderror" />
                                @error('phone')
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="font-semibold text-sm text-gray-700 block mb-1">Alamat Lengkap Pengiriman *</label>
                                <textarea name="shipping_address" rows="3" required placeholder="Tuliskan alamat lengkap beserta kelurahan, kecamatan, kota, dan kode pos..." class="w-full bg-surface-container-low text-body-md py-2 px-3 rounded-lg border border-outline-variant focus:border-primary outline-none transition-all @error('shipping_address') border-red-500 @enderror">{{ old('shipping_address', $user->address) }}</textarea>
                                @error('shipping_address')
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </section>

                    <!-- Section: Order List -->
                    <section class="space-y-md">
                        <h2 class="font-headline-md text-on-surface flex items-center gap-xs">
                            <span class="material-symbols-outlined text-primary">medication</span>
                            Daftar Pesanan
                        </h2>
                        <!-- Cart Items Container -->
                        <div class="bg-white rounded-xl shadow-sm border border-outline-variant overflow-hidden">
                            @foreach($cartItems as $item)
                                <div class="p-md flex gap-md group border-b border-surface-container last:border-b-0">
                                    <div class="w-20 h-20 rounded-lg bg-surface-container-low overflow-hidden flex-shrink-0">
                                        @if(Str::startsWith($item['product']->image, 'http'))
                                            <img class="w-full h-full object-cover" src="{{ $item['product']->image }}" alt="{{ $item['product']->name }}" />
                                        @else
                                            <img class="w-full h-full object-cover" src="{{ asset($item['product']->image) }}" alt="{{ $item['product']->name }}" />
                                        @endif
                                    </div>
                                    <div class="flex-1 flex flex-col justify-between">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h3 class="font-semibold text-on-surface text-base">{{ $item['product']->name }}</h3>
                                                <p class="text-caption text-on-surface-variant">Kategori: {{ $item['product']->category->name }}</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-bold text-primary">Rp {{ number_format($item['product']->price, 0, ',', '.') }}</p>
                                                <p class="text-caption text-on-surface-variant">{{ $item['quantity'] }} unit</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- Courier Selection -->
                    <section class="bg-surface-container-low p-md rounded-xl border border-outline-variant">
                        <h3 class="font-semibold text-on-surface mb-sm flex items-center gap-xs">
                            <span class="material-symbols-outlined text-[20px]">local_shipping</span>
                            Pilih Pengiriman
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-sm">
                            <label class="p-md bg-white rounded-lg text-left border-2 border-primary ring-2 ring-primary/10 cursor-pointer courier-btn" data-cost="15000">
                                <div class="flex justify-between items-center mb-xs">
                                    <div class="flex items-center gap-2">
                                        <input type="radio" name="courier" value="JNE Reguler" checked class="w-4 h-4 text-primary focus:ring-primary courier-radio" />
                                        <span class="font-semibold text-on-surface">JNE Reguler (2-3 Hari)</span>
                                    </div>
                                    <span class="text-label-md text-primary font-bold">Rp 15.000</span>
                                </div>
                                <p class="text-caption text-on-surface-variant pl-6">Pengiriman Reguler Obat Hewan</p>
                            </label>
                            
                            <label class="p-md bg-white rounded-lg text-left border border-outline-variant hover:border-primary transition-all cursor-pointer courier-btn" data-cost="45000">
                                <div class="flex justify-between items-center mb-xs">
                                    <div class="flex items-center gap-2">
                                        <input type="radio" name="courier" value="Express (1 Hari)" class="w-4 h-4 text-primary focus:ring-primary courier-radio" />
                                        <span class="font-semibold text-on-surface">Express YES (1 Hari)</span>
                                    </div>
                                    <span class="text-label-md text-on-surface font-bold">Rp 45.000</span>
                                </div>
                                <p class="text-caption text-on-surface-variant pl-6">Layanan Kilat Cold Chain Safety</p>
                            </label>
                        </div>
                    </section>
                </div>

                <!-- Right Column: Sticky Summary -->
                <div class="lg:col-span-4">
                    <div class="sticky top-[88px] space-y-md">
                        <!-- Payment Method -->
                        <div class="bg-white p-md rounded-xl shadow-md border border-outline-variant space-y-md">
                            <h3 class="font-semibold text-on-surface uppercase tracking-wider text-xs border-b pb-2">Metode Pembayaran</h3>
                            <div class="space-y-sm">
                                <label class="flex items-center justify-between p-sm rounded-lg border border-primary/20 bg-blue-50/10 cursor-pointer pm-btn">
                                    <div class="flex items-center gap-sm">
                                        <input type="radio" name="pay_radio" value="BCA Virtual Account" checked class="w-4 h-4 text-primary focus:ring-primary pm-radio" />
                                        <div class="w-10 h-6 bg-white rounded border border-outline-variant flex items-center justify-center font-bold text-[10px] text-blue-800">BCA</div>
                                        <span class="text-body-md text-on-surface font-medium">BCA Virtual Account</span>
                                    </div>
                                </label>
                                
                                <label class="flex items-center justify-between p-sm rounded-lg border border-outline-variant hover:border-primary cursor-pointer pm-btn">
                                    <div class="flex items-center gap-sm">
                                        <input type="radio" name="pay_radio" value="Mandiri Bill Payment" class="w-4 h-4 text-primary focus:ring-primary pm-radio" />
                                        <div class="w-10 h-6 bg-white rounded border border-outline-variant flex items-center justify-center font-bold text-[10px] text-blue-500">MANDIRI</div>
                                        <span class="text-body-md text-on-surface font-medium">Mandiri Bill Payment</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="bg-white p-md rounded-xl shadow-md border border-outline-variant space-y-md">
                            <h3 class="font-semibold text-on-surface uppercase tracking-wider text-xs border-b border-surface-container pb-xs">Ringkasan Transaksi</h3>
                            <div class="space-y-sm">
                                <div class="flex justify-between text-body-md text-on-surface-variant">
                                    <span>Total Harga ({{ array_sum(session('cart', [])) }} Barang)</span>
                                    <span id="txt-subtotal" data-value="{{ $totalPrice }}">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-body-md text-on-surface-variant">
                                    <span>Total Ongkos Kirim</span>
                                    <span id="txt-shipping-cost">Rp 15.000</span>
                                </div>
                                <div class="flex justify-between text-body-md text-on-surface-variant">
                                    <span>Biaya Layanan</span>
                                    <span>Rp 2.000</span>
                                </div>
                                <div class="flex justify-between text-body-md text-success font-semibold">
                                    <span>Diskon Promo</span>
                                    <span>-Rp 0</span>
                                </div>
                            </div>
                            <div class="pt-md border-t border-dashed border-outline-variant flex justify-between items-center">
                                <span class="font-bold text-on-surface text-lg">Total Tagihan</span>
                                <span class="font-extrabold text-primary text-[22px]" id="txt-grandtotal">Rp {{ number_format($totalPrice + 15000 + 2000, 0, ',', '.') }}</span>
                            </div>
                            
                            <button type="submit" id="btn-submit-checkout" class="w-full bg-primary text-white py-3 rounded-xl font-bold text-lg hover:bg-primary/95 active:scale-[0.98] transition-all shadow-md">
                                Bayar Sekarang
                            </button>
                            
                            <!-- Security Badges -->
                            <div class="pt-sm flex flex-col items-center gap-sm">
                                <div class="flex items-center gap-xs text-caption text-on-surface-variant">
                                    <span class="material-symbols-outlined text-[16px] text-primary">security</span>
                                    Safe and secure pharmaceutical fulfillment
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Update Shipping Courier Selection
                    const courierButtons = document.querySelectorAll('.courier-btn');
                    const courierRadios = document.querySelectorAll('.courier-radio');
                    
                    courierButtons.forEach(btn => {
                        btn.addEventListener('click', function() {
                            // Reset classes
                            courierButtons.forEach(b => {
                                b.classList.remove('border-2', 'border-primary', 'ring-2', 'ring-primary/10');
                                b.classList.add('border', 'border-outline-variant');
                            });
                            
                            // Set this button active
                            this.classList.remove('border', 'border-outline-variant');
                            this.classList.add('border-2', 'border-primary', 'ring-2', 'ring-primary/10');
                            
                            // Check radio
                            const radio = this.querySelector('.courier-radio');
                            radio.checked = true;
                            
                            // Update shipping cost and totals
                            const cost = parseInt(this.getAttribute('data-cost')) || 0;
                            document.getElementById('input-shipping-cost').value = cost;
                            document.getElementById('txt-shipping-cost').textContent = 'Rp ' + cost.toLocaleString('id-ID');
                            
                            recalculateTotals();
                        });
                    });

                    // Update Payment Method Selection
                    const pmButtons = document.querySelectorAll('.pm-btn');
                    const pmRadios = document.querySelectorAll('.pm-radio');
                    
                    pmButtons.forEach(btn => {
                        btn.addEventListener('click', function() {
                            pmButtons.forEach(b => {
                                b.classList.remove('border-primary/20', 'bg-blue-50/10');
                                b.classList.add('border-outline-variant');
                            });
                            
                            this.classList.remove('border-outline-variant');
                            this.classList.add('border-primary/20', 'bg-blue-50/10');
                            
                            const radio = this.querySelector('.pm-radio');
                            radio.checked = true;
                            
                            document.getElementById('input-payment-method').value = radio.value;
                        });
                    });

                    // Recalculate Totals Function
                    function recalculateTotals() {
                        const subtotal = parseInt(document.getElementById('txt-subtotal').getAttribute('data-value')) || 0;
                        const shipping = parseInt(document.getElementById('input-shipping-cost').value) || 0;
                        const service = parseInt(document.getElementById('input-service-fee').value) || 0;
                        const discount = parseInt(document.getElementById('input-discount').value) || 0;
                        
                        const grandTotal = subtotal + shipping + service - discount;
                        document.getElementById('txt-grandtotal').textContent = 'Rp ' + grandTotal.toLocaleString('id-ID');
                    }

                    // Form submission spinner effect
                    const form = document.getElementById('checkout-form');
                    const submitBtn = document.getElementById('btn-submit-checkout');
                    
                    form.addEventListener('submit', function() {
                        submitBtn.innerHTML = '<span class="animate-spin material-symbols-outlined align-middle mr-1">sync</span> Memproses Pembayaran...';
                        submitBtn.disabled = true;
                        submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
                    });
                });
            </script>
            <!-- Decorative Background Element -->
            <div class="fixed top-0 right-0 -z-10 w-1/3 h-full opacity-5 pointer-events-none">
                <svg class="w-full h-full" viewbox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
                    <path class="text-primary"
                        d="M44.7,-76.4C58.3,-69.2,70,-58.5,78.2,-45.5C86.4,-32.5,91,-16.3,90.2,-0.4C89.4,15.4,83.3,30.8,74.5,44.7C65.7,58.6,54.3,71,40.3,77.7C26.3,84.4,9.6,85.4,-6.1,82.4C-21.8,79.4,-36.5,72.4,-49.5,63.1C-62.5,53.8,-73.7,42.2,-79.8,28.4C-85.8,14.6,-86.7,-1.4,-83.4,-16.4C-80,-31.4,-72.4,-45.4,-61.4,-54.6C-50.5,-63.8,-36.2,-68.2,-22.6,-75.4C-9,-82.6,4,-92.6,17.4,-92.1C30.8,-91.6,31.1,-83.6,44.7,-76.4Z"
                        fill="currentColor" transform="translate(200 200)"></path>
                </svg>
            </div>

    </main>
@endsection
