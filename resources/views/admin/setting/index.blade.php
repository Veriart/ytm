@extends('admin.layout')

@section('content')
<!-- Page Header -->
<div class="py-2 border-b border-slate-100 dark:border-slate-800">
    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Pengaturan Website</h1>
    <p class="text-sm text-slate-500 dark:text-slate-400">Kelola identitas visual, logo instansi, dan spanduk spanduk utama halaman depan toko.</p>
</div>

<!-- Notification -->
@if(session('success'))
    <div class="flex items-center gap-3 p-4 bg-emerald-50 dark:bg-emerald-950/20 text-emerald-800 dark:text-emerald-300 rounded-xl border border-emerald-100 dark:border-emerald-900/50 text-sm mt-4">
        <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 dark:text-emerald-400 flex-shrink-0"></i>
        <div class="font-medium">{{ session('success') }}</div>
    </div>
@endif

<form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 mt-6">
    @csrf
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Left Column: Logo Settings (Span 4) -->
        <div class="lg:col-span-4 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm p-6 space-y-4">
            <h3 class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-700 pb-3 flex items-center gap-2">
                <i data-lucide="image" class="w-5 h-5 text-emerald-500"></i>
                Aset Logo Website
            </h3>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Logo Saat Ini</label>
                <div class="p-4 bg-slate-50 dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-xl flex items-center justify-center min-h-[100px]">
                    <img src="{{ $logo }}" alt="Logo Preview" class="max-h-16 w-auto object-contain" />
                </div>
            </div>

            <div>
                <label for="settingLogo" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Unggah Logo Baru</label>
                <div class="border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-2xl p-6 text-center hover:bg-slate-50/50 dark:hover:bg-slate-900/30 transition-colors relative cursor-pointer group">
                    <input type="file" name="logo" id="settingLogo" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10" />
                    <div class="space-y-1 text-center">
                        <i data-lucide="upload-cloud" class="w-8 h-8 text-slate-400 group-hover:text-emerald-500 mx-auto transition-colors"></i>
                        <p class="text-xs font-bold text-slate-600 dark:text-slate-300">Klik untuk upload logo</p>
                        <p class="text-[10px] text-slate-400">Rekomendasi ukuran landscape. Maks 2MB.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: 3 Banner Carousel Configs (Span 8) -->
        <div class="lg:col-span-8 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm p-6 space-y-4">
            <h3 class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-700 pb-3 flex items-center gap-2">
                <i data-lucide="gallery-horizontal-end" class="w-5 h-5 text-emerald-500"></i>
                Kelola 3 Banner Carousel Halaman Home
            </h3>

            <!-- Custom Tailwind Tab Navigation -->
            <div class="border-b border-slate-100 dark:border-slate-700">
                <nav class="flex space-x-6" aria-label="Tabs">
                    <button type="button" class="tab-link border-emerald-500 text-emerald-600 dark:text-emerald-400 px-1 py-3.5 border-b-2 font-bold text-sm select-none cursor-pointer focus:outline-none transition-colors" data-target="#bannerTab1">
                        Banner 1
                    </button>
                    <button type="button" class="tab-link border-transparent text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 px-1 py-3.5 border-b-2 font-semibold text-sm select-none cursor-pointer focus:outline-none transition-colors" data-target="#bannerTab2">
                        Banner 2
                    </button>
                    <button type="button" class="tab-link border-transparent text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 px-1 py-3.5 border-b-2 font-semibold text-sm select-none cursor-pointer focus:outline-none transition-colors" data-target="#bannerTab3">
                        Banner 3
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="mt-4">
                <!-- TAB 1 CONTENT -->
                <div id="bannerTab1" class="tab-pane space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Gambar Banner 1 Saat Ini</label>
                        <div class="rounded-xl overflow-hidden border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 max-h-[160px]">
                            <img src="{{ $bannerImage1 }}" alt="Banner 1 Preview" class="w-full h-36 object-cover" />
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label for="settingBanner1" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Unggah Gambar Banner 1 Baru</label>
                            <input type="file" name="banner_image_1" id="settingBanner1" accept="image/*" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" />
                        </div>
                        
                        <div>
                            <label for="bannerTitle1" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Judul Banner 1</label>
                            <input type="text" name="banner_title_1" id="bannerTitle1" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" value="{{ old('banner_title_1', $bannerTitle1) }}" placeholder="Contoh: Solusi Kesehatan Hewan Terpercaya" required />
                        </div>
                        
                        <div>
                            <label for="bannerLink1" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Link Banner 1</label>
                            <input type="text" name="banner_link_1" id="bannerLink1" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" value="{{ old('banner_link_1', $bannerLink1) }}" placeholder="/category/cats" />
                        </div>
                        
                        <div class="sm:col-span-2">
                            <label for="bannerSubtitle1" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Deskripsi / Subtitle 1</label>
                            <textarea name="banner_subtitle_1" id="bannerSubtitle1" rows="3" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" required>{{ old('banner_subtitle_1', $bannerSubtitle1) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- TAB 2 CONTENT -->
                <div id="bannerTab2" class="tab-pane space-y-4 hidden">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Gambar Banner 2 Saat Ini</label>
                        <div class="rounded-xl overflow-hidden border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 max-h-[160px]">
                            <img src="{{ $bannerImage2 }}" alt="Banner 2 Preview" class="w-full h-36 object-cover" />
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label for="settingBanner2" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Unggah Gambar Banner 2 Baru</label>
                            <input type="file" name="banner_image_2" id="settingBanner2" accept="image/*" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" />
                        </div>
                        
                        <div>
                            <label for="bannerTitle2" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Judul Banner 2</label>
                            <input type="text" name="banner_title_2" id="bannerTitle2" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" value="{{ old('banner_title_2', $bannerTitle2) }}" placeholder="Contoh: Grosir Peralatan Medis" required />
                        </div>
                        
                        <div>
                            <label for="bannerLink2" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Link Banner 2</label>
                            <input type="text" name="banner_link_2" id="bannerLink2" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" value="{{ old('banner_link_2', $bannerLink2) }}" placeholder="/category/livestock" />
                        </div>
                        
                        <div class="sm:col-span-2">
                            <label for="bannerSubtitle2" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Deskripsi / Subtitle 2</label>
                            <textarea name="banner_subtitle_2" id="bannerSubtitle2" rows="3" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" required>{{ old('banner_subtitle_2', $bannerSubtitle2) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- TAB 3 CONTENT -->
                <div id="bannerTab3" class="tab-pane space-y-4 hidden">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Gambar Banner 3 Saat Ini</label>
                        <div class="rounded-xl overflow-hidden border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 max-h-[160px]">
                            <img src="{{ $bannerImage3 }}" alt="Banner 3 Preview" class="w-full h-36 object-cover" />
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label for="settingBanner3" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Unggah Gambar Banner 3 Baru</label>
                            <input type="file" name="banner_image_3" id="settingBanner3" accept="image/*" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" />
                        </div>
                        
                        <div>
                            <label for="bannerTitle3" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Judul Banner 3</label>
                            <input type="text" name="banner_title_3" id="bannerTitle3" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" value="{{ old('banner_title_3', $bannerTitle3) }}" placeholder="Contoh: Suplemen Nutrisi Premium" required />
                        </div>
                        
                        <div>
                            <label for="bannerLink3" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Link Banner 3</label>
                            <input type="text" name="banner_link_3" id="bannerLink3" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" value="{{ old('banner_link_3', $bannerLink3) }}" placeholder="/product/vitamin-c" />
                        </div>
                        
                        <div class="sm:col-span-2">
                            <label for="bannerSubtitle3" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Deskripsi / Subtitle 3</label>
                            <textarea name="banner_subtitle_3" id="bannerSubtitle3" rows="3" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" required>{{ old('banner_subtitle_3', $bannerSubtitle3) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Save button wrapper -->
    <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm p-4 flex items-center justify-end gap-2">
        <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-semibold text-sm hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
            Batal
        </a>
        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition-all shadow-sm hover:shadow-emerald-600/10 flex items-center gap-2">
            <i data-lucide="save" class="w-4 h-4"></i>
            Simpan Pengaturan
        </button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabLinks = document.querySelectorAll('.tab-link');
        const tabPanes = document.querySelectorAll('.tab-pane');

        tabLinks.forEach(link => {
            link.addEventListener('click', function () {
                // Remove active classes from all tab links
                tabLinks.forEach(item => {
                    item.classList.remove('border-emerald-500', 'text-emerald-600', 'dark:text-emerald-400', 'font-bold');
                    item.classList.add('border-transparent', 'text-slate-400', 'font-semibold');
                });
                
                // Add active classes to selected tab link
                this.classList.remove('border-transparent', 'text-slate-400', 'font-semibold');
                this.classList.add('border-emerald-500', 'text-emerald-600', 'dark:text-emerald-400', 'font-bold');
                
                // Hide all tab panes
                tabPanes.forEach(pane => {
                    pane.classList.add('hidden');
                });
                
                // Show matching tab pane
                const target = this.getAttribute('data-target');
                document.querySelector(target).classList.remove('hidden');
            });
        });
    });
</script>
@endsection
