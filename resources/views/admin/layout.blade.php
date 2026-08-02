<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50 dark:bg-slate-900">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Yakin Tri Medika | Veterinary Pharmacy Admin Portal</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/img/ytm.jpeg" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- Tailwind CSS (Vite & CDN Backup for zero setup issues) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            navy: '#0f172a', // Deep Navy
                            slate: '#1e293b', // Dark Slate
                            emerald: '#059669', // Emerald Green
                            teal: '#0d9488', // Teal Green
                            accent: '#10b981', // Light Accent Green
                        }
                    }
                }
            }
        }
    </script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body
    class="h-full text-slate-800 dark:text-slate-100 flex flex-col md:flex-row overflow-hidden bg-slate-50 dark:bg-slate-900">

    <!-- Mobile Header/Navbar -->
    <header
        class="flex items-center justify-between px-4 py-3 bg-slate-900 text-white md:hidden border-b border-slate-800 z-30">
        <div class="flex items-center gap-3">
            <img src="{{ \App\Models\Setting::getValue('logo', '/img/ytm.jpeg') }}" alt="Logo"
                class="h-8 w-auto rounded" />
            <span class="font-bold text-sm tracking-wide">Yakin Tri Medika</span>
        </div>
        <button id="mobile-menu-btn"
            class="p-1 rounded text-slate-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
    </header>

    <!-- Sidebar Wrapper for Mobile Backdrop -->
    <div id="sidebar-backdrop"
        class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 hidden md:hidden transition-opacity duration-300">
    </div>

    <!-- Sidebar Component -->
    <aside id="sidebar-menu"
        class="fixed inset-y-0 left-0 w-64 bg-slate-900 dark:bg-slate-950 text-slate-100 flex flex-col z-50 transform -translate-x-full transition-transform duration-300 md:relative md:translate-x-0 md:flex flex-shrink-0 border-r border-slate-800 dark:border-slate-800/50">
        <!-- Brand Header -->
        <div class="h-16 flex items-center justify-between px-6 border-b border-slate-800">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <img src="{{ \App\Models\Setting::getValue('logo', '/img/ytm.jpeg') }}" alt="Logo"
                    class="h-9 w-auto rounded object-contain" />
                <span
                    class="font-bold text-base tracking-wide bg-gradient-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent">YTM
                    Farmasi</span>
            </a>
            <!-- Mobile Close Button -->
            <button id="mobile-menu-close" class="p-1 rounded text-slate-400 hover:text-white md:hidden">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Sidebar Navigation Menu -->
        <div class="flex-1 overflow-y-auto px-4 py-6 space-y-7 hide-scrollbar">
            <!-- Main Actions -->
            <div class="space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Request::routeIs('admin.dashboard') ? 'bg-emerald-600/10 text-emerald-400 border-l-4 border-emerald-500 pl-2' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/50' }}">
                    <i data-lucide="layout-dashboard"
                        class="w-5 h-5 {{ Request::routeIs('admin.dashboard') ? 'text-emerald-400' : 'text-slate-400 group-hover:text-slate-100' }}"></i>
                    Dashboard Overview
                </a>
            </div>

            <!-- Produk Section -->
            <div class="space-y-2">
                <span class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider block">Manajemen
                    Produk</span>
                <div class="space-y-1">
                    <a href="{{ route('admin.product.index') }}"
                        class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Request::routeIs('admin.product.*') ? 'bg-emerald-600/10 text-emerald-400 border-l-4 border-emerald-500 pl-2' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/50' }}">
                        <i data-lucide="package"
                            class="w-5 h-5 {{ Request::routeIs('admin.product.*') ? 'text-emerald-400' : 'text-slate-400 group-hover:text-slate-100' }}"></i>
                        Katalog Obat
                    </a>
                    <a href="{{ route('admin.category.index') }}"
                        class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Request::routeIs('admin.category.*') ? 'bg-emerald-600/10 text-emerald-400 border-l-4 border-emerald-500 pl-2' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/50' }}">
                        <i data-lucide="tags"
                            class="w-5 h-5 {{ Request::routeIs('admin.category.*') ? 'text-emerald-400' : 'text-slate-400 group-hover:text-slate-100' }}"></i>
                        Kategori Obat
                    </a>
                    {{-- <a href="#"
                        class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-slate-100 hover:bg-slate-800/50 transition-all">
                        <i data-lucide="shield-alert" class="w-5 h-5 text-slate-400 group-hover:text-slate-100"></i>
                        Golongan Obat
                    </a> --}}
                </div>
            </div>

            <!-- Stok & Inventaris -->
            {{-- <div class="space-y-2">
                <span class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider block">Stok &amp;
                    Inventaris</span>
                <div class="space-y-1">
                    <a href="{{ route('admin.product.index') }}?filter=low_stock"
                        class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-slate-100 hover:bg-slate-800/50 transition-all">
                        <i data-lucide="trending-down" class="w-5 h-5 text-slate-400 group-hover:text-slate-100"></i>
                        Peringatan Stok Tipis
                    </a>
                    <a href="{{ route('admin.dashboard') }}#expiry-alert"
                        class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-slate-100 hover:bg-slate-800/50 transition-all">
                        <i data-lucide="calendar" class="w-5 h-5 text-slate-400 group-hover:text-slate-100"></i>
                        Expiry Tracker
                    </a>
                    <a href="#"
                        class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-slate-100 hover:bg-slate-800/50 transition-all">
                        <i data-lucide="layers" class="w-5 h-5 text-slate-400 group-hover:text-slate-100"></i>
                        Nomor Batch &amp; Lot
                    </a>
                </div>
            </div> --}}

            <!-- Transaksi -->
            <div class="space-y-2">
                <span class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider block">Pesanan &amp;
                    Transaksi</span>
                <div class="space-y-1">
                    <a href="{{ route('admin.transaction.index') }}"
                        class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Request::routeIs('admin.transaction.*') ? 'bg-emerald-600/10 text-emerald-400 border-l-4 border-emerald-500 pl-2' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/50' }}">
                        <i data-lucide="shopping-cart"
                            class="w-5 h-5 {{ Request::routeIs('admin.transaction.*') ? 'text-emerald-400' : 'text-slate-400 group-hover:text-slate-100' }}"></i>
                        Daftar Pesanan
                    </a>
                </div>
            </div>

            <!-- Laporan -->
            {{-- <div class="space-y-2">
                <span class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider block">Analitik</span>
                <div class="space-y-1">
                    <a href="#"
                        class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-slate-100 hover:bg-slate-800/50 transition-all">
                        <i data-lucide="bar-chart-3" class="w-5 h-5 text-slate-400 group-hover:text-slate-100"></i>
                        Laporan Penjualan
                    </a>
                    <a href="#"
                        class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-slate-100 hover:bg-slate-800/50 transition-all">
                        <i data-lucide="paw-print" class="w-5 h-5 text-slate-400 group-hover:text-slate-100"></i>
                        Penjualan per Spesies
                    </a>
                </div>
            </div> --}}

            <!-- Pengaturan -->
            <div class="space-y-2">
                <span class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider block">Pengaturan</span>
                <div class="space-y-1">
                    <a href="{{ route('admin.setting.index') }}"
                        class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all {{ Request::routeIs('admin.setting.*') ? 'bg-emerald-600/10 text-emerald-400 border-l-4 border-emerald-500 pl-2' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/50' }}">
                        <i data-lucide="sliders"
                            class="w-5 h-5 {{ Request::routeIs('admin.setting.*') ? 'text-emerald-400' : 'text-slate-400 group-hover:text-slate-100' }}"></i>
                        Pengaturan Toko
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar Footer/User Profile -->
        <div class="p-4 border-t border-slate-800 flex items-center justify-between">
            <div class="flex items-center gap-3 overflow-hidden">
                <div
                    class="w-9 h-9 rounded-xl bg-emerald-600 text-white font-bold flex items-center justify-center text-sm flex-shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ ucfirst(Auth::user()->role) }}</p>
                </div>
            </div>
            <a href="javascript:void(0);"
                onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();"
                class="text-slate-400 hover:text-rose-400 p-1.5 rounded-lg hover:bg-slate-800 transition-colors"
                title="Keluar">
                <i data-lucide="log-out" class="w-4 h-4"></i>
            </a>
            <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- Top Navbar -->
        <nav
            class="h-16 bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800 px-6 flex items-center justify-between z-10">
            <!-- Left Header -->
            <div class="flex items-center gap-4">
                <span class="text-lg font-bold text-slate-900 dark:text-white hidden md:inline-block">Portal Apoteker
                    &amp; Admin</span>
            </div>

            <!-- Right Controls -->
            <div class="flex items-center gap-4">

                <!-- Quick links -->
                <a href="{{ route('home') }}" target="_blank"
                    class="flex items-center gap-2 text-sm font-medium text-slate-600 hover:text-emerald-600 dark:text-slate-300 dark:hover:text-emerald-400 px-3 py-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    <i data-lucide="external-link" class="w-4 h-4"></i>
                    Lihat Toko
                </a>

                <div class="h-6 w-px bg-slate-200 dark:bg-slate-700"></div>

                <!-- User Dropdown Trigger -->
                <div class="relative" id="user-menu-wrapper">
                    <button id="user-menu-btn"
                        class="flex items-center gap-2 p-1 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none transition-colors">
                        @if (Auth::user()->profile_photo)
                            <img src="{{ Auth::user()->profile_photo }}" alt="Avatar"
                                class="w-8 h-8 rounded-lg object-cover border border-slate-200 dark:border-slate-700" />
                        @else
                            <div
                                class="w-8 h-8 rounded-lg bg-emerald-600 text-white font-bold flex items-center justify-center text-xs">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <span
                            class="text-sm font-medium hidden sm:inline text-slate-700 dark:text-slate-200">{{ Auth::user()->name }}</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400"></i>
                    </button>

                    <!-- User Dropdown Menu -->
                    <div id="user-dropdown"
                        class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-100 dark:border-slate-700 py-1 hidden z-20 transition-all transform origin-top-right scale-95 opacity-0">
                        <div class="px-4 py-2 border-b border-slate-100 dark:border-slate-700">
                            <p class="text-sm font-bold text-slate-800 dark:text-white">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.index') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                            <i data-lucide="user" class="w-4 h-4 text-slate-400"></i>
                            Edit Profil
                        </a>
                        <a href="{{ route('admin.setting.index') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                            <i data-lucide="sliders" class="w-4 h-4 text-slate-400"></i>
                            Pengaturan Toko
                        </a>
                        <hr class="border-slate-100 dark:border-slate-700 my-1" />
                        <a href="javascript:void(0);"
                            onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();"
                            class="flex items-center gap-2 px-4 py-2 text-sm text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/20 transition-colors">
                            <i data-lucide="log-out" class="w-4 h-4 text-rose-500"></i>
                            Log Out
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto bg-slate-50 dark:bg-slate-900 p-6 md:p-8 space-y-6">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer
            class="h-14 bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800 px-6 flex items-center justify-between text-xs text-slate-500 dark:text-slate-400">
            <div>
                &copy; {{ date('Y') }} <span class="font-semibold text-emerald-600">PT Yakin Tri Medika</span>.
                All rights reserved.
            </div>
            <div class="hidden sm:block">
                Portal Administrasi Toko Obat Hewan
            </div>
        </footer>
    </div>

    <!-- Toggle Sidebar JS & Profile Dropdown JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggles
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenuClose = document.getElementById('mobile-menu-close');
            const sidebarBackdrop = document.getElementById('sidebar-backdrop');
            const sidebarMenu = document.getElementById('sidebar-menu');

            function openSidebar() {
                sidebarBackdrop.classList.remove('hidden');
                setTimeout(() => sidebarBackdrop.classList.add('opacity-100'), 10);
                sidebarMenu.classList.remove('-translate-x-full');
            }

            function closeSidebar() {
                sidebarBackdrop.classList.remove('opacity-100');
                sidebarMenu.classList.add('-translate-x-full');
                setTimeout(() => sidebarBackdrop.classList.add('hidden'), 300);
            }

            if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', openSidebar);
            if (mobileMenuClose) mobileMenuClose.addEventListener('click', closeSidebar);
            if (sidebarBackdrop) sidebarBackdrop.addEventListener('click', closeSidebar);

            // User Profile Dropdown
            const userMenuBtn = document.getElementById('user-menu-btn');
            const userDropdown = document.getElementById('user-dropdown');
            const userMenuWrapper = document.getElementById('user-menu-wrapper');

            if (userMenuBtn) {
                userMenuBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isHidden = userDropdown.classList.contains('hidden');
                    if (isHidden) {
                        userDropdown.classList.remove('hidden');
                        setTimeout(() => {
                            userDropdown.classList.remove('scale-95', 'opacity-0');
                            userDropdown.classList.add('scale-100', 'opacity-100');
                        }, 10);
                    } else {
                        userDropdown.classList.remove('scale-100', 'opacity-100');
                        userDropdown.classList.add('scale-95', 'opacity-0');
                        setTimeout(() => userDropdown.classList.add('hidden'), 150);
                    }
                });
            }

            document.addEventListener('click', function(e) {
                if (userMenuWrapper && !userMenuWrapper.contains(e.target)) {
                    userDropdown.classList.remove('scale-100', 'opacity-100');
                    userDropdown.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => userDropdown.classList.add('hidden'), 150);
                }
            });

            // Initialize Lucide Icons
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
</body>

</html>
