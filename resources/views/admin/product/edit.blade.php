@extends('admin.layout')

@section('content')
    <!-- Page Header -->
    <div class="flex items-center gap-4 py-2 border-b border-slate-100 dark:border-slate-800">
        <a href="{{ route('admin.product.index') }}"
            class="p-2 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors shadow-sm">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Produk Obat Hewan</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400">Perbarui spesifikasi dan informasi produk obat hewan.</p>
        </div>
    </div>

    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data"
        class="space-y-6 mt-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Left Side: Core Info (Col Span 7) -->
            <div class="lg:col-span-7 space-y-6">
                <!-- Card 1: Core Details -->
                <div
                    class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm p-6 space-y-4">
                    <h3
                        class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-700 pb-3 flex items-center gap-2">
                        <i data-lucide="info" class="w-5 h-5 text-emerald-500"></i>
                        Informasi Utama Produk
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Product Name -->
                        <div class="sm:col-span-2">
                            <label for="prodName"
                                class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Nama
                                Obat / Produk</label>
                            <input type="text" id="prodName" name="name" required
                                value="{{ old('name', $product->name) }}" placeholder="Contoh: Apoquel 16mg"
                                class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all @error('name') border-rose-500 focus:ring-rose-500 @enderror" />
                            @error('name')
                                <p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Manufacturer / Brand -->
                        <div>
                            <label for="prodBrand"
                                class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Merek
                                / Produsen</label>
                            <input type="text" id="prodBrand" name="brand" value="{{ old('brand', $product->brand) }}"
                                placeholder="Contoh: Zoetis"
                                class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" />
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="categorySelect"
                                class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Kategori
                                Obat</label>
                            <select id="categorySelect" name="category_id" required
                                class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all @error('category_id') border-rose-500 focus:ring-rose-500 @enderror">
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label for="prodPrice"
                                class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Harga
                                Jual (Rp)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-2.5 text-sm text-slate-400 font-semibold">Rp</span>
                                <input type="number" id="prodPrice" name="price" required
                                    value="{{ old('price', $product->price) }}" placeholder="Contoh: 150000"
                                    class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all @error('price') border-rose-500 focus:ring-rose-500 @enderror" />
                            </div>
                            @error('price')
                                <p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Stock -->
                        <div>
                            <label for="prodStock"
                                class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Stok</label>
                            <input type="number" id="prodStock" name="stock" required
                                value="{{ old('stock', $product->stock) }}"
                                class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all @error('stock') border-rose-500 focus:ring-rose-500 @enderror" />
                            @error('stock')
                                <p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Card 2: Photo and Description -->
                <div
                    class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm p-6 space-y-4">
                    <h3
                        class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-700 pb-3 flex items-center gap-2">
                        <i data-lucide="file-text" class="w-5 h-5 text-emerald-500"></i>
                        Media &amp; Deskripsi Detail
                    </h3>

                    <!-- Current Image & Replace -->
                    <div>
                        <label
                            class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Foto
                            Saat Ini</label>
                        <div class="mb-3">
                            @if (Str::startsWith($product->image, 'http'))
                                <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                    class="w-32 h-32 rounded-xl object-cover border border-slate-200 dark:border-slate-700" />
                            @else
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                    class="w-32 h-32 rounded-xl object-cover border border-slate-200 dark:border-slate-700" />
                            @endif
                        </div>

                        <label
                            class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Ganti
                            Foto Baru</label>
                        <div
                            class="border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-2xl p-6 text-center hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-colors relative cursor-pointer group">
                            <input type="file" name="image" id="prodImage" accept="image/*"
                                class="absolute inset-0 opacity-0 cursor-pointer z-10" />
                            <div class="space-y-1 text-center">
                                <i data-lucide="image-plus"
                                    class="w-8 h-8 text-slate-400 group-hover:text-emerald-500 mx-auto transition-colors"></i>
                                <p class="text-xs font-bold text-slate-600 dark:text-slate-300">Klik untuk upload foto baru
                                </p>
                                <p class="text-[10px] text-slate-400">Biarkan kosong jika tidak ingin mengganti. Maks 2MB.
                                </p>
                            </div>
                        </div>
                        @error('image')
                            <p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="prodDesc"
                            class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Deskripsi
                            Lengkap</label>
                        <textarea id="prodDesc" name="description" rows="5" required
                            class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all @error('description') border-rose-500 focus:ring-rose-500 @enderror">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Right Side: Veterinary Fields (Col Span 5) -->
            <div class="lg:col-span-5 space-y-6">
                <!-- Card 3: Medical / Farmasi Spesifikasi -->
                {{-- <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm p-6 space-y-4">
                <h3 class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-700 pb-3 flex items-center gap-2">
                    <i data-lucide="stethoscope" class="w-5 h-5 text-emerald-500"></i>
                    Detail Medis &amp; Farmasi Hewan
                </h3>

                <!-- Prescription Only Checkbox (Needs Prescription) -->
                <div class="p-4 rounded-xl bg-slate-50 dark:bg-slate-900/40 border border-slate-100 dark:border-slate-800 flex items-start gap-3">
                    <div class="flex items-center h-5">
                        <input id="needsPrescription" name="needs_prescription" value="1" type="checkbox" {{ old('needs_prescription', $product->needs_prescription) ? 'checked' : '' }} class="h-4.5 w-4.5 rounded border-slate-300 dark:border-slate-700 text-emerald-600 focus:ring-emerald-500 cursor-pointer" />
                    </div>
                    <div class="text-xs">
                        <label for="needsPrescription" class="font-bold text-slate-800 dark:text-white select-none cursor-pointer flex items-center gap-1.5">
                            Wajib Resep Dokter Hewan (R/)
                        </label>
                        <p class="text-slate-400 mt-1">Centang jika obat ini termasuk golongan obat keras yang mewajibkan unggah berkas resep dari dokter hewan berizin.</p>
                    </div>
                </div>

                <!-- Target Animals (Multi-select Badges Style) -->
                <div>
                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Spesies Target Hewan</label>
                    <div class="flex flex-wrap gap-2">
                        @php
                            $selectedAnimals = $product->target_animals ? explode(', ', $product->target_animals) : [];
                        @endphp
                        @foreach (['Sapi', 'Kambing', 'Domba', 'Unggas', 'Anjing', 'Kucing', 'Hewan Eksotis'] as $animal)
                            <label class="cursor-pointer">
                                <input type="checkbox" name="target_animals[]" value="{{ $animal }}" class="peer sr-only" {{ in_array($animal, old('target_animals', $selectedAnimals)) ? 'checked' : '' }} />
                                <span class="inline-block px-3 py-2 rounded-xl text-xs font-semibold border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 peer-checked:bg-emerald-600 peer-checked:border-emerald-600 peer-checked:text-white transition-all shadow-sm">
                                    {{ $animal }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Dosage Form & Active Ingredients -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="dosageForm" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Bentuk Sediaan</label>
                        <select id="dosageForm" name="dosage_form" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all">
                            <option value="" disabled>Pilih Bentuk...</option>
                            @foreach (['Tablet', 'Kapsul', 'Salep', 'Injeksi / Cairan Suntik', 'Sirup / Cairan Oral', 'Drop / Tetes', 'Powder / Serbuk'] as $form)
                                <option value="{{ $form }}" {{ old('dosage_form', $product->dosage_form) == $form ? 'selected' : '' }}>{{ $form }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="activeIngredients" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Kandungan Bahan Aktif</label>
                        <input type="text" id="activeIngredients" name="active_ingredients" value="{{ old('active_ingredients', $product->active_ingredients) }}" placeholder="Contoh: Oclacitinib" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" />
                    </div>
                </div>

                <!-- Registration / BPOM / Kementan Number -->
                <div>
                    <label for="regNumber" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">No. Registrasi / Izin Edar Kementan/BPOM</label>
                    <input type="text" id="regNumber" name="registration_number" value="{{ old('registration_number', $product->registration_number) }}" placeholder="Contoh: KEMENTAN RI No. D. 19085994 PKC. 1" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" />
                </div>

                <!-- Batch Tracking & Expiry Date -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="batchNum" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Nomor Batch / Lot</label>
                        <input type="text" id="batchNum" name="batch_number" value="{{ old('batch_number', $product->batch_number) }}" placeholder="Contoh: B10294" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" />
                    </div>

                    <div>
                        <label for="expiryDate" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Tanggal Kadaluarsa</label>
                        <input type="date" id="expiryDate" name="expiry_date" value="{{ old('expiry_date', $product->expiry_date ? $product->expiry_date->format('Y-m-d') : '') }}" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" />
                    </div>
                </div>
            </div> --}}

                <!-- Card 4: Medical Administration & Notes -->
                <div
                    class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm p-6 space-y-4">
                    <h3
                        class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-700 pb-3 flex items-center gap-2">
                        <i data-lucide="clipboard-list" class="w-5 h-5 text-emerald-500"></i>
                        Petunjuk &amp; Catatan Khusus
                    </h3>

                    <!-- Dosage Guidelines -->
                    <div>
                        <label for="prodDosage"
                            class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Pedoman
                            Dosis &amp; Administrasi</label>
                        <textarea id="prodDosage" name="dosage_guidelines" rows="3"
                            placeholder="Cara pemberian, rute administrasi, dan dosis..."
                            class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all">{{ old('dosage_guidelines', $product->dosage_guidelines) }}</textarea>
                    </div>

                    <!-- Medical Indication -->
                    <div>
                        <label for="prodIndication"
                            class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Indikasi
                            Medis</label>
                        <textarea id="prodIndication" name="indication" rows="3" placeholder="Penyakit target, gejala klinis..."
                            class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all">{{ old('indication', $product->indication) }}</textarea>
                    </div>

                    <!-- Pharmacist Note -->
                    <div>
                        <label for="prodNote"
                            class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Catatan
                            Apoteker / Dokter Hewan</label>
                        <textarea id="prodNote" name="pharmacist_note" rows="3"
                            placeholder="Penyimpanan, kontraindikasi, withdrawal time..."
                            class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all">{{ old('pharmacist_note', $product->pharmacist_note) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Footer -->
        <div class="flex items-center gap-3 justify-end pt-4 border-t border-slate-200 dark:border-slate-800">
            <a href="{{ route('admin.product.index') }}"
                class="px-5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-semibold text-sm hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                Batal
            </a>
            <button type="submit"
                class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition-all shadow-sm hover:shadow-emerald-600/10">
                Simpan Perubahan
            </button>
        </div>
    </form>
@endsection
