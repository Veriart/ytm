@extends('layout')

@section('content')
<main class="max-w-4xl mx-auto px-margin-mobile md:px-margin-desktop py-md min-h-screen">
    <h1 class="text-2xl font-bold mb-6 text-on-surface flex items-center gap-xs">
        <span class="material-symbols-outlined text-primary">person</span>
        Pengaturan Profil Saya
    </h1>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6 text-sm font-semibold shadow-sm flex items-center gap-xs">
            <span class="material-symbols-outlined text-green-600 text-[18px]">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6 text-sm font-semibold shadow-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
            <!-- Left Column: Avatar Upload and Preview -->
            <div class="md:col-span-4">
                <div class="bg-surface-container-lowest p-md rounded-xl border border-outline-variant shadow-sm text-center flex flex-col items-center">
                    <h3 class="font-label-md text-label-md text-primary mb-4">Foto Profil</h3>
                    
                    <div class="relative w-32 h-32 mb-4 group">
                        <!-- Preview Image -->
                        <div class="w-full h-full rounded-full border border-outline-variant bg-surface-container overflow-hidden shadow-sm flex items-center justify-center">
                            @if($user->profile_photo)
                                <img id="avatar-preview" src="{{ $user->profile_photo }}" alt="Profile Photo" class="w-full h-full object-cover" />
                            @else
                                <div id="avatar-fallback" class="w-full h-full bg-primary text-white flex items-center justify-center font-bold text-4xl">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <img id="avatar-preview" src="" alt="Profile Photo" class="w-full h-full object-cover hidden" />
                            @endif
                        </div>
                    </div>

                    <!-- Input Upload File -->
                    <label class="w-full bg-surface-container hover:bg-surface-container-high text-on-surface border border-outline-variant py-2 px-4 rounded-lg font-label-md text-xs cursor-pointer transition-all active:scale-95 flex items-center justify-center gap-xs">
                        <span class="material-symbols-outlined text-[16px]">upload</span>
                        Pilih Foto Baru
                        <input type="file" name="profile_photo" id="profile_photo_input" class="hidden" accept="image/*" />
                    </label>
                    <p class="text-[10px] text-on-surface-variant mt-2">Format: JPG, PNG, WEBP. Maks 2MB.</p>

                    <hr class="w-full my-4 border-outline-variant/40" />

                    <!-- User Badges -->
                    <div class="space-y-1">
                        <span class="font-bold text-on-surface block text-body-md">{{ $user->name }}</span>
                        <span class="text-caption text-on-surface-variant block">{{ $user->email }}</span>
                        <span class="inline-block bg-primary/10 text-primary text-[10px] px-2.5 py-0.5 rounded-full font-bold uppercase mt-1">{{ $user->role }}</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Personal Details & Shipping Address -->
            <div class="md:col-span-8">
                <div class="bg-surface-container-lowest p-md rounded-xl border border-outline-variant shadow-sm space-y-md">
                    <h3 class="font-headline-md text-headline-md border-b pb-2 text-on-surface">Informasi Pribadi</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-md">
                        <div>
                            <label class="block text-xs font-semibold text-on-surface-variant mb-1" for="name">Nama Lengkap</label>
                            <input type="text" name="name" id="name" required value="{{ old('name', $user->name) }}" class="w-full bg-surface-container-low text-body-md py-2 px-3 rounded-lg border border-outline-variant focus:border-primary outline-none" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-on-surface-variant mb-1" for="email">Alamat Email</label>
                            <input type="email" name="email" id="email" required value="{{ old('email', $user->email) }}" class="w-full bg-surface-container-low text-body-md py-2 px-3 rounded-lg border border-outline-variant focus:border-primary outline-none" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-md">
                        <div>
                            <label class="block text-xs font-semibold text-on-surface-variant mb-1" for="phone">Nomor Telepon</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 08123456789" class="w-full bg-surface-container-low text-body-md py-2 px-3 rounded-lg border border-outline-variant focus:border-primary outline-none" />
                        </div>
                    </div>

                    <h3 class="font-headline-md text-headline-md border-b pb-2 pt-2 text-on-surface">Alamat Pengiriman Utama</h3>

                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1" for="address">Alamat Pengiriman Lengkap</label>
                        <textarea name="address" id="address" rows="4" placeholder="Tuliskan nama jalan, RT/RW, nomor rumah, kecamatan, kabupaten, provinsi, dan kode pos..." class="w-full bg-surface-container-low text-body-md py-2 px-3 rounded-lg border border-outline-variant focus:border-primary outline-none">{{ old('address', $user->address) }}</textarea>
                        <small class="text-on-surface-variant text-[11px] block mt-1">Alamat ini akan otomatis digunakan sebagai alamat pengiriman default saat checkout belanja obat hewan.</small>
                    </div>

                    <div class="pt-2 d-flex gap-2">
                        <button type="submit" class="bg-primary text-white py-2 px-6 rounded-lg font-label-md text-label-md hover:opacity-95 active:scale-95 transition-all shadow-sm">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('home') }}" class="inline-block bg-surface-container hover:bg-surface-container-high border border-outline-variant py-2 px-6 rounded-lg font-label-md text-label-md transition-all">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('profile_photo_input');
        const previewImage = document.getElementById('avatar-preview');
        const fallbackAvatar = document.getElementById('avatar-fallback');

        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (previewImage) {
                            previewImage.src = e.target.result;
                            previewImage.classList.remove('hidden');
                        }
                        if (fallbackAvatar) {
                            fallbackAvatar.classList.add('hidden');
                        }
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endpush
