<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>PT Yakin Tri Medika</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="icon" type="image/jpeg" href="{{ asset('img/ytm.jpeg') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" />
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-container": "#737575",
                        "inverse-primary": "#6bd8cb",
                        "background": "#f8f9ff",
                        "on-primary-fixed-variant": "#005049",
                        "on-primary-fixed": "#00201d",
                        "surface": "#f8f9ff",
                        "surface-tint": "#006a61",
                        "on-background": "#0d1c2f",
                        "secondary-container": "#fd761a",
                        "outline-variant": "#bcc9c6",
                        "error": "#ba1a1a",
                        "surface-variant": "#d5e3fd",
                        "inverse-on-surface": "#ebf1ff",
                        "primary-fixed": "#89f5e7",
                        "surface-container-highest": "#d5e3fd",
                        "primary-container": "#008378",
                        "on-primary": "#ffffff",
                        "surface-dim": "#ccdbf4",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#eff4ff",
                        "outline": "#6d7a77",
                        "on-secondary-container": "#5c2400",
                        "on-secondary": "#ffffff",
                        "on-tertiary-container": "#fcfcfc",
                        "on-tertiary": "#ffffff",
                        "on-error-container": "#93000a",
                        "on-secondary-fixed-variant": "#783200",
                        "on-tertiary-fixed-variant": "#454747",
                        "surface-container": "#e6eeff",
                        "tertiary-fixed": "#e2e2e2",
                        "on-secondary-fixed": "#341100",
                        "error-container": "#ffdad6",
                        "primary": "#00685f",
                        "surface-container-high": "#dde9ff",
                        "secondary": "#9d4300",
                        "surface-bright": "#f8f9ff",
                        "on-primary-container": "#f4fffc",
                        "on-surface": "#0d1c2f",
                        "on-surface-variant": "#3d4947",
                        "tertiary": "#5a5c5c",
                        "tertiary-fixed-dim": "#c6c6c7",
                        "on-tertiary-fixed": "#1a1c1c",
                        "on-error": "#ffffff",
                        "secondary-fixed": "#ffdbca",
                        "primary-fixed-dim": "#6bd8cb",
                        "inverse-surface": "#233144",
                        "secondary-fixed-dim": "#ffb690"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "xs": "8px",
                        "xl": "80px",
                        "margin-desktop": "64px",
                        "md": "24px",
                        "sm": "16px",
                        "margin-mobile": "16px",
                        "lg": "48px",
                        "base": "4px",
                        "gutter": "24px"
                    },
                    "fontFamily": {
                        "label-md": ["Inter"],
                        "body-md": ["Inter"],
                        "headline-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "caption": ["Inter"],
                        "headline-lg": ["Inter"],
                        "display-lg": ["Inter"]
                    },
                    "fontSize": {
                        "label-md": ["14px", {
                            "lineHeight": "20px",
                            "fontWeight": "600"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "headline-md": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "600"
                        }],
                        "body-lg": ["18px", {
                            "lineHeight": "28px",
                            "fontWeight": "400"
                        }],
                        "headline-lg-mobile": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "600"
                        }],
                        "caption": ["12px", {
                            "lineHeight": "16px",
                            "fontWeight": "400"
                        }],
                        "headline-lg": ["32px", {
                            "lineHeight": "40px",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
                        }],
                        "display-lg": ["48px", {
                            "lineHeight": "56px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }]
                    }
                },
            },
        }
    </script>
</head>

<body
    class="bg-surface font-body-md text-on-surface selection:bg-primary-container selection:text-on-primary-container">
    <!-- TopNavBar Shell (Modern Glassmorphism) -->
    <header
        class="sticky top-0 w-full z-50 flex flex-col items-center bg-white/80 backdrop-blur-md px-margin-mobile md:px-margin-desktop border-b border-outline-variant/30 shadow-sm">
        <div class="max-w-[1280px] w-full h-16 flex items-center justify-between gap-gutter">
            <!-- Brand Logo -->
            <div class="flex items-center gap-xs shrink-0 hover:scale-[1.02] transition-transform duration-200">
                <a href="/">
                    <img alt="Yakin Tri Medika Logo" class="h-10 w-auto object-contain"
                        src="{{ \App\Models\Setting::getValue('logo', '/img/ytm.jpeg') }}" />
                </a>
            </div>

            <!-- Search Bar (Header - Desktop & Tablet) -->
            <form action="{{ route('home') }}" method="GET"
                class="hidden md:flex flex-1 max-w-xs lg:max-w-sm relative mx-4">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}" />
                @endif
                @if (request('target'))
                    <input type="hidden" name="target" value="{{ request('target') }}" />
                @endif
                <div class="relative w-full">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari obat hewan, merek, bahan..."
                        class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-xs pl-9 pr-3 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all shadow-inner" />
                    <span class="material-symbols-outlined absolute left-3 top-2 text-slate-400 text-base">search</span>
                </div>
            </form>

            <!-- Category Links (Modern Pills) -->
            <nav class="hidden lg:flex items-center gap-xs">
                <a class="px-4 py-1.5 rounded-full text-label-md font-semibold transition-all duration-200 {{ !request('category') || request('category') == 'all' ? 'bg-primary text-white shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-primary' }}"
                    href="{{ route('home', array_merge(request()->query(), ['category' => 'all'])) }}">All</a>
                @foreach (\App\Models\Category::all() as $cat)
                    <a class="px-4 py-1.5 rounded-full text-label-md font-semibold transition-all duration-200 {{ request('category') == $cat->slug ? 'bg-primary text-white shadow-sm' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-primary' }}"
                        href="{{ route('home', array_merge(request()->query(), ['category' => $cat->slug])) }}">{{ $cat->name }}</a>
                @endforeach
            </nav>

            <!-- Actions & Auth -->
            <div class="flex items-center gap-sm">
                <!-- Cart Widget -->
                <div class="relative me-1">
                    <a href="{{ route('cart.index') }}"
                        class="relative p-2.5 text-outline hover:text-primary hover:bg-surface-container-low rounded-full flex items-center justify-center transition-all"
                        style="font-size: 24px;">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        <span
                            class="absolute px-0.5 top-0 right-0 bg-secondary text-white text-[9px] w-4.5 h-4.5 rounded-full flex items-center justify-center font-bold border-2 border-white shadow-sm">
                            {{ session('cart') ? array_sum(session('cart')) : 0 }}
                        </span>
                    </a>
                </div>

                @if (!Auth::check())
                    <!-- Guest Actions -->
                    <a href="{{ route('login') }}"
                        class="px-4 py-1.5 border border-primary text-primary rounded-full font-label-md text-label-md hover:bg-primary/5 transition-all">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-1.5 bg-primary text-white rounded-full font-label-md text-label-md hover:opacity-90 shadow-sm transition-all active:scale-95">
                        Daftar
                    </a>
                @else
                    <!-- Authenticated User Profile Pill Dropdown -->
                    <div class="relative">
                        <button type="button"
                            class="flex items-center gap-2 px-3 py-1.5 rounded-full border border-outline-variant hover:bg-surface-container-low transition-all focus:outline-none"
                            id="profile-pill-trigger">
                            @if (Auth::user()->profile_photo)
                                <img src="{{ Auth::user()->profile_photo }}" alt="Avatar"
                                    class="w-4 h-4 rounded-full object-cover shadow-sm" />
                            @else
                                <div
                                    class="w-6.5 h-6.5 px-1.5 py-1 rounded-full bg-primary text-white flex items-center justify-center font-bold text-xs shadow-sm">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <span
                                class="text-body-md font-semibold text-on-surface hidden md:inline max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                            <span class="material-symbols-outlined text-[16px] text-outline">expand_more</span>
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white border border-outline-variant rounded-xl shadow-lg py-2 hidden transition-all duration-200"
                            id="profile-dropdown-menu" style="z-index: 100;">
                            <div class="px-4 py-2 border-b border-outline-variant/40">
                                <span
                                    class="text-[10px] uppercase tracking-wider text-on-surface-variant font-bold block">Masuk
                                    Sebagai</span>
                                <span class="font-bold text-sm text-on-surface truncate block"
                                    title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</span>
                            </div>

                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex items-center gap-2 px-4 py-2 text-sm text-on-surface hover:bg-primary/5 transition-colors">
                                    <span class="material-symbols-outlined text-[18px] text-primary">dashboard</span>
                                    Panel Admin
                                </a>
                            @endif

                            <a href="{{ route('profile.index') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-on-surface hover:bg-primary/5 transition-colors">
                                <span class="material-symbols-outlined text-[18px] text-primary">person</span>
                                Edit Profil
                            </a>

                            <a href="{{ route('transactions.history') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-on-surface hover:bg-primary/5 transition-colors">
                                <span class="material-symbols-outlined text-[18px] text-primary">history</span>
                                Riwayat Transaksi
                            </a>

                            <hr class="my-1 border-outline-variant/40" />

                            <a href="javascript:void(0);"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-danger hover:bg-danger/5 transition-colors">
                                <span class="material-symbols-outlined text-[18px] text-danger">logout</span>
                                Log Out
                            </a>
                        </div>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @endif
            </div>
        </div>

        <!-- Subnav (Mobile) -->
        <div
            class="w-full bg-surface-container-lowest lg:hidden flex justify-center py-2 border-t border-outline-variant/30">
            <nav
                class="max-w-[1280px] w-full px-margin-mobile flex gap-xs overflow-x-auto hide-scrollbar scroll-smooth">
                <a class="px-3.5 py-1 rounded-full text-label-md font-semibold whitespace-nowrap transition-all duration-200 {{ !request('category') || request('category') == 'all' ? 'bg-primary text-white shadow-sm' : 'text-on-surface-variant hover:text-primary' }}"
                    href="{{ route('home', array_merge(request()->query(), ['category' => 'all'])) }}">All</a>
                @foreach (\App\Models\Category::all() as $cat)
                    <a class="px-3.5 py-1 rounded-full text-label-md font-semibold whitespace-nowrap transition-all duration-200 {{ request('category') == $cat->slug ? 'bg-primary text-white shadow-sm' : 'text-on-surface-variant hover:text-primary' }}"
                        href="{{ route('home', array_merge(request()->query(), ['category' => $cat->slug])) }}">{{ $cat->name }}</a>
                @endforeach
            </nav>
        </div>
    </header>

    @yield('content')

    <!-- Footer Shell -->
    <footer
        class="w-full py-lg px-margin-mobile md:px-margin-desktop grid grid-cols-1 md:grid-cols-4 gap-gutter bg-surface-container-low border-t border-outline-variant">
        <div class="flex flex-col gap-sm">
            <img alt="PT Yakin Tri Medika Logo" class="h-12 w-fit grayscale opacity-70 mb-2 object-contain"
                src="{{ \App\Models\Setting::getValue('logo', '/img/ytm.jpeg') }}" />
            <p class="text-caption font-caption text-on-surface-variant leading-relaxed">
                PT Yakin Tri Medika adalah distributor resmi produk farmasi hewan dan peralatan medis terpercaya di
                Indonesia sejak 2024.
            </p>
        </div>
        <div class="flex flex-col gap-sm">
            <h4 class="font-label-md text-label-md text-primary">Yakin Tri Medika</h4>
            <a class="text-on-surface-variant font-label-md text-label-md hover:text-secondary transition-colors"
                href="#">Tentang Kami</a>
            <a class="text-on-surface-variant font-label-md text-label-md hover:text-secondary transition-colors"
                href="#">Licensed Pharmacy</a>
            <a class="text-on-surface-variant font-label-md text-label-md hover:text-secondary transition-colors"
                href="#">Karir</a>
            <a class="text-on-surface-variant font-label-md text-label-md hover:text-secondary transition-colors"
                href="#">Hubungi Kami</a>
        </div>
        <div class="flex flex-col gap-sm">
            <h4 class="font-label-md text-label-md text-primary">Layanan Pelanggan</h4>
            <a class="text-on-surface-variant font-label-md text-label-md hover:text-secondary transition-colors"
                href="#">Support Contacts</a>
            <a class="text-on-surface-variant font-label-md text-label-md hover:text-secondary transition-colors"
                href="#">Emergency Hotline</a>
            <a class="text-on-surface-variant font-label-md text-label-md hover:text-secondary transition-colors"
                href="#">Shipping Partners</a>
            <a class="text-on-surface-variant font-label-md text-label-md hover:text-secondary transition-colors"
                href="#">Kebijakan Privasi</a>
        </div>
        <div class="flex flex-col gap-sm">
            <h4 class="font-label-md text-label-md text-primary">Ikuti Kami</h4>
            <div class="flex gap-md mb-4">
                <span
                    class="material-symbols-outlined text-on-surface-variant hover:text-primary cursor-pointer">face_nod</span>
                <span
                    class="material-symbols-outlined text-on-surface-variant hover:text-primary cursor-pointer">photo_camera</span>
                <span
                    class="material-symbols-outlined text-on-surface-variant hover:text-primary cursor-pointer">alternate_email</span>
            </div>
            <div class="flex flex-wrap gap-2">
                <div
                    class="h-8 w-12 bg-white rounded border border-outline-variant flex items-center justify-center text-[10px] font-bold text-on-surface-variant">
                    VISA</div>
                <div
                    class="h-8 w-12 bg-white rounded border border-outline-variant flex items-center justify-center text-[10px] font-bold text-on-surface-variant">
                    BCA</div>
                <div
                    class="h-8 w-12 bg-white rounded border border-outline-variant flex items-center justify-center text-[10px] font-bold text-on-surface-variant">
                    MANDIRI</div>
            </div>
        </div>
        <div class="md:col-span-4 pt-lg border-t border-outline-variant mt-md">
            <p class="text-caption font-caption text-on-surface-variant text-center">
                © 2024 Yakin Tri Medika Licensed Veterinary Pharmacy. All rights reserved.
            </p>
        </div>
    </footer>
    <!-- FAB for focused task -->
    <div class="fixed bottom-margin-mobile right-margin-mobile z-40">
        <button
            class="bg-secondary text-white w-14 h-14 rounded-full flex items-center justify-center shadow-lg hover:scale-110 active:scale-95 transition-all focus:ring-2 focus:ring-primary">
            <span class="material-symbols-outlined" data-icon="chat">chat</span>
        </button>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        // Simple search bar focus micro-interaction
        const searchInput = document.querySelector('input[type="text"]');
        if (searchInput) {
            searchInput.addEventListener('focus', () => {
                searchInput.parentElement.classList.add('scale-[1.01]');
            });
            searchInput.addEventListener('blur', () => {
                searchInput.parentElement.classList.remove('scale-[1.01]');
            });
        }

        // Profile dropdown menu toggle
        const profileTrigger = document.getElementById('profile-pill-trigger');
        const profileMenu = document.getElementById('profile-dropdown-menu');
        if (profileTrigger && profileMenu) {
            profileTrigger.addEventListener('click', function(e) {
                e.stopPropagation();
                profileMenu.classList.toggle('hidden');
            });
            document.addEventListener('click', function(e) {
                if (!profileMenu.contains(e.target) && e.target !== profileTrigger) {
                    profileMenu.classList.add('hidden');
                }
            });
        }
    </script>
    <!-- Floating Toast Notification -->
    @if (session('success') || session('error'))
        <div id="toast-notification"
            class="fixed top-20 right-6 z-50 transform translate-y-0 opacity-100 transition-all duration-500 max-w-sm w-full bg-white dark:bg-slate-800 rounded-2xl shadow-xl border {{ session('success') ? 'border-emerald-100 dark:border-emerald-900/50' : 'border-rose-100 dark:border-rose-900/50' }} p-4 flex gap-3">
            <div
                class="w-8 h-8 rounded-full {{ session('success') ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }} flex items-center justify-center flex-shrink-0">
                <span
                    class="material-symbols-outlined text-[20px]">{{ session('success') ? 'check_circle' : 'error' }}</span>
            </div>
            <div class="flex-1 text-xs">
                <p class="font-bold text-slate-800 dark:text-white">
                    {{ session('success') ? 'Berhasil' : 'Pemberitahuan' }}</p>
                <p class="text-slate-500 dark:text-slate-400 mt-0.5">{{ session('success') ?? session('error') }}</p>
            </div>
            <button
                onclick="document.getElementById('toast-notification').classList.add('translate-y-[-20px]', 'opacity-0'); setTimeout(() => document.getElementById('toast-notification').remove(), 500);"
                class="text-slate-400 hover:text-slate-600 dark:hover:text-white">
                <span class="material-symbols-outlined text-[16px]">close</span>
            </button>
        </div>
        <script>
            setTimeout(() => {
                const toast = document.getElementById('toast-notification');
                if (toast) {
                    toast.classList.add('translate-y-[-20px]', 'opacity-0');
                    setTimeout(() => toast.remove(), 500);
                }
            }, 4000);
        </script>
    @endif

    @stack('script')
</body>

</html>
