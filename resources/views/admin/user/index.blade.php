@extends('admin.layout')

@section('content')
    <!-- Page Header -->
    <div class="py-2 border-b border-slate-100 dark:border-slate-800">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Kelola User</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400">Atur pengguna sistem YTM (Administrator dan Pelanggan).</p>
    </div>

    <!-- Notifications -->
    @if (session('success'))
        <div class="flex items-center gap-3 p-4 bg-emerald-50 dark:bg-emerald-950/20 text-emerald-800 dark:text-emerald-300 rounded-xl border border-emerald-100 dark:border-emerald-900/50 text-sm mt-4">
            <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600 dark:text-emerald-400 flex-shrink-0"></i>
            <div class="font-medium">{{ session('success') }}</div>
        </div>
    @endif

    @if (session('error'))
        <div class="flex items-center gap-3 p-4 bg-rose-50 dark:bg-rose-950/20 text-rose-800 dark:text-rose-300 rounded-xl border border-rose-100 dark:border-rose-900/50 text-sm mt-4">
            <i data-lucide="alert-circle" class="w-5 h-5 text-rose-600 dark:text-rose-400 flex-shrink-0"></i>
            <div class="font-medium">{{ session('error') }}</div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-6">
        <!-- User List Table (Col Span 8) -->
        <div class="lg:col-span-8 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
                <h3 class="text-base font-bold text-slate-900 dark:text-white">Daftar Pengguna</h3>
                <span class="text-xs font-semibold bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 px-3 py-1 rounded-full">
                    {{ count($users) }} Pengguna
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900/50 text-slate-500 dark:text-slate-400 border-b border-slate-100 dark:border-slate-800 text-xs font-bold uppercase tracking-wider">
                            <th class="px-6 py-4 w-16 text-center">No.</th>
                            <th class="px-6 py-4">Nama / Email</th>
                            <th class="px-6 py-4">Peran (Role)</th>
                            <th class="px-6 py-4">Telepon / Alamat</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @forelse($users as $idx => $user)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4 text-center text-slate-400 font-semibold">
                                    {{ $idx + 1 }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900 dark:text-white">{{ $user->name }}</div>
                                    <div class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->role === 'admin')
                                        <span class="inline-flex items-center text-xs font-semibold bg-emerald-50 dark:bg-emerald-950/20 text-emerald-700 dark:text-emerald-400 px-2.5 py-1 rounded-full border border-emerald-100 dark:border-emerald-900/50">
                                            Administrator
                                        </span>
                                    @else
                                        <span class="inline-flex items-center text-xs font-semibold bg-blue-50 dark:bg-blue-950/20 text-blue-700 dark:text-blue-400 px-2.5 py-1 rounded-full border border-blue-100 dark:border-blue-900/50">
                                            Customer
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-500 dark:text-slate-400">
                                    <div class="font-semibold text-slate-700 dark:text-slate-300 text-xs">{{ $user->phone ?? '-' }}</div>
                                    <div class="text-[11px] max-w-xs truncate mt-0.5">{{ $user->address ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-2">
                                        <button class="btn-edit inline-flex items-center gap-1 text-xs font-bold text-amber-600 hover:text-white border border-amber-100 hover:border-amber-600 hover:bg-amber-600 px-3 py-1.5 rounded-lg transition-colors"
                                            data-id="{{ $user->id }}" 
                                            data-name="{{ $user->name }}" 
                                            data-email="{{ $user->email }}" 
                                            data-role="{{ $user->role }}"
                                            data-phone="{{ $user->phone }}"
                                            data-address="{{ $user->address }}">
                                            <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                            Edit
                                        </button>

                                        @if($user->id !== Auth::id())
                                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini? Akun tidak akan dapat digunakan lagi.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-1 text-xs font-bold text-rose-600 hover:text-white border border-rose-100 hover:border-rose-600 hover:bg-rose-600 px-3 py-1.5 rounded-lg transition-colors">
                                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        @else
                                            <button class="inline-flex items-center gap-1 text-xs font-bold text-slate-300 dark:text-slate-600 border border-slate-100 dark:border-slate-700 px-3 py-1.5 rounded-lg cursor-not-allowed" disabled title="Tidak dapat menghapus akun Anda sendiri">
                                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                Hapus
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400 dark:text-slate-500">
                                    <i data-lucide="users" class="w-12 h-12 mx-auto text-slate-300 dark:text-slate-600 mb-3"></i>
                                    <p class="font-bold text-sm">Belum ada pengguna terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create User Form (Col Span 4) -->
        <div class="lg:col-span-4 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-800/80 rounded-2xl shadow-sm p-6 h-fit">
            <h3 class="text-base font-bold text-slate-900 dark:text-white border-b border-slate-100 dark:border-slate-700 pb-3 flex items-center gap-2 mb-4">
                <i data-lucide="plus-circle" class="w-5 h-5 text-emerald-500"></i>
                Tambah User Baru
            </h3>

            <form action="{{ route('admin.user.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="userName" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <input type="text" id="userName" name="name" required placeholder="Contoh: Drh. Budi" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" />
                </div>

                <div>
                    <label for="userEmail" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Email Address</label>
                    <input type="email" id="userEmail" name="email" required placeholder="Contoh: budi@gmail.com" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" />
                </div>

                <div>
                    <label for="userPassword" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Password</label>
                    <input type="password" id="userPassword" name="password" required minlength="6" placeholder="Minimal 6 karakter" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" />
                </div>

                <div>
                    <label for="userRole" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Peran (Role)</label>
                    <select id="userRole" name="role" required class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all">
                        <option value="customer">Customer / Pelanggan</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>

                <div>
                    <label for="userPhone" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Nomor Telepon</label>
                    <input type="text" id="userPhone" name="phone" placeholder="Contoh: 08123456789" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" />
                </div>

                <div>
                    <label for="userAddress" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Alamat Rumah</label>
                    <textarea id="userAddress" name="address" rows="3" placeholder="Alamat lengkap tempat tinggal..." class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all"></textarea>
                </div>

                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2.5 rounded-xl text-sm transition-all shadow-sm flex items-center justify-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Simpan User
                </button>
            </form>
        </div>
    </div>

    <!-- Edit User Modal Wrapper -->
    <div id="edit-user-modal" class="fixed inset-0 z-50 overflow-y-auto hidden flex items-center justify-center p-4">
        <!-- Backdrop overlay -->
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity duration-300"></div>

        <!-- Modal Box Container -->
        <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 max-w-md w-full overflow-hidden transform transition-all scale-95 opacity-0 duration-300 z-10">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
                <h3 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <i data-lucide="edit" class="w-5 h-5 text-amber-500"></i>
                    Edit Data Pengguna
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
                        <label for="editUserName" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Nama Lengkap</label>
                        <input type="text" id="editUserName" name="name" required class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" />
                    </div>

                    <div>
                        <label for="editUserEmail" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Email Address</label>
                        <input type="email" id="editUserEmail" name="email" required class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" />
                    </div>

                    <div>
                        <label for="editUserPassword" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Ganti Password Baru</label>
                        <input type="password" id="editUserPassword" name="password" minlength="6" placeholder="Biarkan kosong jika tidak ingin diubah" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" />
                    </div>

                    <div>
                        <label for="editUserRole" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Peran (Role)</label>
                        <select id="editUserRole" name="role" required class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all">
                            <option value="customer">Customer / Pelanggan</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>

                    <div>
                        <label for="editUserPhone" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Nomor Telepon</label>
                        <input type="text" id="editUserPhone" name="phone" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all" />
                    </div>

                    <div>
                        <label for="editUserAddress" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Alamat Rumah</label>
                        <textarea id="editUserAddress" name="address" rows="3" class="w-full bg-slate-50/50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:text-white transition-all"></textarea>
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
        document.addEventListener('DOMContentLoaded', function() {
            const editModal = document.getElementById('edit-user-modal');
            const modalContainer = editModal.querySelector('.relative.bg-white');
            const editForm = document.getElementById('editForm');
            
            const editName = document.getElementById('editUserName');
            const editEmail = document.getElementById('editUserEmail');
            const editPassword = document.getElementById('editUserPassword');
            const editRole = document.getElementById('editUserRole');
            const editPhone = document.getElementById('editUserPhone');
            const editAddress = document.getElementById('editUserAddress');

            const editButtons = document.querySelectorAll('.btn-edit');
            const closeButton = document.getElementById('modal-close-btn');
            const cancelButton = document.getElementById('modal-cancel-btn');

            function openModal(id, name, email, role, phone, address) {
                editForm.action = `/admin/user/${id}`;
                editName.value = name;
                editEmail.value = email;
                editPassword.value = ''; // clear password input field
                editRole.value = role;
                editPhone.value = phone || '';
                editAddress.value = address || '';

                editModal.classList.remove('hidden');
                setTimeout(() => {
                    editModal.querySelector('.fixed.inset-0').classList.add('opacity-100');
                    modalContainer.classList.remove('scale-95', 'opacity-0');
                    modalContainer.classList.add('scale-100', 'opacity-100');
                }, 10);
            }

            function closeModal() {
                modalContainer.classList.remove('scale-100', 'opacity-100');
                modalContainer.classList.add('scale-95', 'opacity-0');
                editModal.querySelector('.fixed.inset-0').classList.remove('opacity-100');
                setTimeout(() => {
                    editModal.classList.add('hidden');
                }, 300);
            }

            editButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const email = this.getAttribute('data-email');
                    const role = this.getAttribute('data-role');
                    const phone = this.getAttribute('data-phone');
                    const address = this.getAttribute('data-address');
                    openModal(id, name, email, role, phone, address);
                });
            });

            if (closeButton) closeButton.addEventListener('click', closeModal);
            if (cancelButton) cancelButton.addEventListener('click', closeModal);

            editModal.addEventListener('click', function(e) {
                if (e.target === editModal || e.target.classList.contains('backdrop-blur-sm')) {
                    closeModal();
                }
            });
        });
    </script>
@endsection
