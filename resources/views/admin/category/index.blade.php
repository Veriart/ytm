@extends('admin.layout')

@section('content')
<!-- Page Header -->
<div class="py-2 border-b border-slate-100 dark:border-slate-800">
    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Kategori &amp; Spesies Target</h1>
    <p class="text-sm text-slate-500 dark:text-slate-400">Kelola kelompok terapi obat dan kategori target hewan.</p>
</div>

<!-- Notifications -->
@if(session('success'))
    <div class="flex items-center gap-3 p-4 bg-emerald-50 dark:bg-emerald-950/20 text-emerald-800 dark:text-emerald-300 rounded-xl border border-emerald-100 dark:border-emerald-900/50 text-sm mt-4">
        <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 dark:text-emerald-400 flex-shrink-0"></i>
        <div class="font-medium">{{ session('success') }}</div>
    </div>
@endif

@if(session('error'))
    <div class="flex items-center gap-3 p-4 bg-rose-50 dark:bg-rose-950/20 text-rose-800 dark:text-rose-300 rounded-xl border border-rose-100 dark:border-rose-900/50 text-sm mt-4">
        <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 dark:text-rose-400 flex-shrink-0"></i>
        <div class="font-medium">{{ session('error') }}</div>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-6">
    <!-- Category List Table (Col Span 8) -->
    <div class="lg:col-span-8 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
            <h3 class="text-base font-bold text-slate-900 dark:text-white">Daftar Kategori</h3>
            <span class="text-xs font-semibold bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 px-3 py-1 rounded-full">{{ count($categories) }} Kategori</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/50 text-slate-500 dark:text-slate-400 border-b border-slate-100 dark:border-slate-800 text-xs font-bold uppercase tracking-wider">
                        <th class="px-6 py-4 w-16 text-center">No.</th>
                        <th class="px-6 py-4">Nama Kategori</th>
                        <th class="px-6 py-4">Slug</th>
                        <th class="px-6 py-4">Jumlah Produk</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($categories as $idx => $cat)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                            <td class="px-6 py-4 text-center text-slate-400 font-semibold">
                                {{ $idx + 1 }}
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-900 dark:text-white">
                                {{ $cat->name }}
                            </td>
                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">
                                {{ $cat->slug }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center text-xs font-semibold bg-emerald-50 dark:bg-emerald-950/20 text-emerald-700 dark:text-emerald-400 px-2.5 py-1 rounded-full border border-emerald-100 dark:border-emerald-900/50">
                                    {{ $cat->products_count }} Produk
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="btn-edit inline-flex items-center gap-1 text-xs font-bold text-amber-600 hover:text-white border border-amber-100 hover:border-amber-600 hover:bg-amber-600 px-3 py-1.5 rounded-lg transition-colors"
                                            data-id="{{ $cat->id }}" 
                                            data-name="{{ $cat->name }}">
                                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                        Edit
                                    </button>
                                    
                                    <form action="{{ route('admin.category.destroy', $cat->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Seluruh produk di bawah kategori ini juga akan terhapus.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1 text-xs font-bold text-rose-600 hover:text-white border border-rose-100 hover:border-rose-600 hover:bg-rose-600 px-3 py-1.5 rounded-lg transition-colors">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 dark:text-slate-500">
                                <i data-lucide="tags" class="w-12 h-12 mx-auto text-slate-300 dark:text-slate-600 mb-3"></i>
                                <p class="font-bold text-sm">Belum ada kategori obat.</p>
                                <p class="text-xs mt-1">Gunakan form di samping kanan untuk mendaftarkan kategori.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Category Form (Col Span 4) -->
    <div class="lg:col-span-4 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm p-6 h-fit">
        <h3 class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-700 pb-3 flex items-center gap-2 mb-4">
            <i data-lucide="plus-circle" class="w-5 h-5 text-emerald-500"></i>
            Tambah Kategori Baru
        </h3>

        <form action="{{ route('admin.category.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="categoryName" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Nama Kategori</label>
                <input type="text" id="categoryName" name="name" required placeholder="Contoh: Antibiotik / Vitamin Unggas" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all @error('name') border-rose-500 focus:ring-rose-500 @enderror" />
                @error('name')
                    <p class="text-xs text-rose-500 mt-1 font-semibold">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2.5 rounded-xl text-sm transition-all shadow-sm hover:shadow-emerald-600/10 flex items-center justify-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                Simpan Kategori
            </button>
        </form>
    </div>
</div>

<!-- Edit Category Modal Dialog wrapper -->
<div id="edit-category-modal" class="fixed inset-0 z-50 overflow-y-auto hidden flex items-center justify-center p-4">
    <!-- Backdrop overlay -->
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity duration-300"></div>

    <!-- Modal Box Container -->
    <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 max-w-md w-full overflow-hidden transform transition-all scale-95 opacity-0 duration-300 z-10">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
            <h3 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                <i data-lucide="edit" class="w-5 h-5 text-amber-500"></i>
                Edit Kategori
            </h3>
            <button id="modal-close-btn" class="p-1.5 rounded-lg text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 hover:text-slate-700 dark:hover:text-white transition-all">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form id="editForm" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-4">
                <div>
                    <label for="editCategoryName" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Nama Kategori</label>
                    <input type="text" id="editCategoryName" name="name" required class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" />
                </div>
            </div>

            <div class="px-6 py-4 bg-slate-50 dark:bg-slate-900/40 border-t border-slate-100 dark:border-slate-700/80 flex items-center justify-end gap-2">
                <button type="button" id="modal-cancel-btn" class="px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-semibold text-xs hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    Batal
                </button>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-xl text-xs transition-all shadow-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editCategoryModal = document.getElementById('edit-category-modal');
        const modalContainer = editCategoryModal.querySelector('.relative.bg-white');
        const editForm = document.getElementById('editForm');
        const editInput = document.getElementById('editCategoryName');
        
        const editButtons = document.querySelectorAll('.btn-edit');
        const closeButton = document.getElementById('modal-close-btn');
        const cancelButton = document.getElementById('modal-cancel-btn');

        function openModal(id, name) {
            editForm.action = `/admin/category/${id}`;
            editInput.value = name;
            
            editCategoryModal.classList.remove('hidden');
            setTimeout(() => {
                editCategoryModal.querySelector('.fixed.inset-0').classList.add('opacity-100');
                modalContainer.classList.remove('scale-95', 'opacity-0');
                modalContainer.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            modalContainer.classList.remove('scale-100', 'opacity-100');
            modalContainer.classList.add('scale-95', 'opacity-0');
            editCategoryModal.querySelector('.fixed.inset-0').classList.remove('opacity-100');
            setTimeout(() => {
                editCategoryModal.classList.add('hidden');
            }, 300);
        }

        editButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                openModal(id, name);
            });
        });

        if (closeButton) closeButton.addEventListener('click', closeModal);
        if (cancelButton) cancelButton.addEventListener('click', closeModal);
        
        // Close modal on click outside modal container
        editCategoryModal.addEventListener('click', function (e) {
            if (e.target === editCategoryModal || e.target.classList.contains('backdrop-blur-sm')) {
                closeModal();
            }
        });
    });
</script>
@endsection
