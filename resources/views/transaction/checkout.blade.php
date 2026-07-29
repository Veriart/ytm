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
                <input type="hidden" name="shipping_cost" id="input-shipping-cost" value="15000" />
                <input type="hidden" name="discount" id="input-discount" value="0" />
                <input type="hidden" name="service_fee" id="input-service-fee" value="2000" />
                <input type="hidden" name="payment_method" id="input-payment-method" value="BCA Virtual Account" />

                <!-- Left Column: Shipping & Order list (Col Span 8) -->
                <div class="lg:col-span-8 space-y-8">
                    <!-- Section: Delivery Address -->
                    <section class="space-y-4">
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
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required placeholder="Contoh: 081234567890" class="w-full bg-slate-50 text-sm py-2.5 px-3 rounded-xl border {{ $errors->has('phone') ? 'border-rose-500 focus:ring-rose-500' : 'border-slate-200 focus:ring-primary' }} focus:outline-none focus:ring-2 focus:border-transparent transition-all" />
                                @error('phone')
                                    <span class="text-rose-500 text-xs mt-1 block font-semibold">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="font-bold text-xs text-slate-400 uppercase tracking-wider block mb-1.5">Alamat Lengkap Pengiriman <span class="text-rose-500">*</span></label>
                                <textarea name="shipping_address" rows="3" required placeholder="Tuliskan alamat lengkap pengiriman secara detail (jalan, nomor rumah, kelurahan, kecamatan, kota/kabupaten, dan kode pos)..." class="w-full bg-slate-50 text-sm py-2.5 px-3 rounded-xl border {{ $errors->has('shipping_address') ? 'border-rose-500 focus:ring-rose-500' : 'border-slate-200 focus:ring-primary' }} focus:outline-none focus:ring-2 focus:border-transparent transition-all">{{ old('shipping_address', $user->address) }}</textarea>
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
                    <section class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                        <h3 class="font-bold text-slate-800 text-sm flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[20px]">local_shipping</span>
                            Pilih Jasa Ekspedisi Pengiriman
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Option 1: JNE Reguler -->
                            <label class="p-4 bg-white rounded-xl text-left border-2 border-primary ring-2 ring-primary/10 cursor-pointer courier-btn block transition-all" data-cost="15000">
                                <div class="flex justify-between items-center mb-1">
                                    <div class="flex items-center gap-2">
                                        <input type="radio" name="courier" value="JNE Reguler" checked class="w-4 h-4 text-primary focus:ring-primary courier-radio cursor-pointer" />
                                        <span class="font-bold text-slate-800 text-sm">JNE Reguler (2-3 Hari)</span>
                                    </div>
                                    <span class="text-sm text-primary font-extrabold">Rp 15.000</span>
                                </div>
                                <p class="text-xs text-slate-400 pl-6">Layanan reguler bersertifikasi cold safety</p>
                            </label>
                            
                            <!-- Option 2: Express YES -->
                            <label class="p-4 bg-white rounded-xl text-left border border-slate-200 hover:border-primary cursor-pointer courier-btn block transition-all" data-cost="45000">
                                <div class="flex justify-between items-center mb-1">
                                    <div class="flex items-center gap-2">
                                        <input type="radio" name="courier" value="Express (1 Hari)" class="w-4 h-4 text-primary focus:ring-primary courier-radio cursor-pointer" />
                                        <span class="font-bold text-slate-800 text-sm">Express YES (1 Hari)</span>
                                    </div>
                                    <span class="text-sm text-slate-700 font-extrabold">Rp 45.000</span>
                                </div>
                                <p class="text-xs text-slate-400 pl-6">Layanan kilat 1 hari dengan box cold chain khusus obat</p>
                            </label>
                        </div>
                    </section>
                </div>

                <!-- Right Column: Sticky Summary & Payment Method (Col Span 4) -->
                <div class="lg:col-span-4">
                    <div class="sticky top-24 space-y-6">
                        <!-- Payment Method selection -->
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 space-y-4">
                            <h3 class="font-bold text-slate-800 text-xs uppercase tracking-wider border-b border-slate-50 pb-2">Metode Pembayaran</h3>
                            <div class="space-y-2">
                                <label class="flex items-center justify-between p-3 rounded-xl border border-primary/20 bg-blue-50/10 cursor-pointer pm-btn transition-all">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" name="pay_radio" value="BCA Virtual Account" checked class="w-4 h-4 text-primary focus:ring-primary pm-radio cursor-pointer" />
                                        <div class="w-10 h-6 bg-white rounded border border-slate-200 flex items-center justify-center font-bold text-[9px] text-blue-800">BCA</div>
                                        <span class="text-sm text-slate-700 font-bold">BCA Virtual Account</span>
                                    </div>
                                </label>
                                
                                <label class="flex items-center justify-between p-3 rounded-xl border border-slate-200 hover:border-primary cursor-pointer pm-btn transition-all">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" name="pay_radio" value="Mandiri Bill Payment" class="w-4 h-4 text-primary focus:ring-primary pm-radio cursor-pointer" />
                                        <div class="w-10 h-6 bg-white rounded border border-slate-200 flex items-center justify-center font-bold text-[9px] text-blue-500">MANDIRI</div>
                                        <span class="text-sm text-slate-700 font-bold">Mandiri Bill Payment</span>
                                    </div>
                                </label>
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
                                    <span id="txt-shipping-cost" class="text-slate-800">Rp 15.000</span>
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
                                <span class="font-extrabold text-primary text-xl" id="txt-grandtotal">Rp {{ number_format($totalPrice + 15000 + 2000, 0, ',', '.') }}</span>
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

            // Update Payment Method selection
            const pmButtons = document.querySelectorAll('.pm-btn');
            
            pmButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Reset all payment button borders
                    pmButtons.forEach(b => {
                        b.classList.remove('border-primary/20', 'bg-blue-50/10');
                        b.classList.add('border-slate-200');
                        b.querySelector('.pm-radio').checked = false;
                    });
                    
                    // Set current clicked button active
                    this.classList.remove('border-slate-200');
                    this.classList.add('border-primary/20', 'bg-blue-50/10');
                    
                    const radio = this.querySelector('.pm-radio');
                    radio.checked = true;
                    
                    document.getElementById('input-payment-method').value = radio.value;
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
