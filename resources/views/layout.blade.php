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
    <!-- TopNavBar Shell -->
    @if (!isset($session->user->role))
        <header
            class="sticky top-0 w-full z-50 flex flex-col items-center bg-surface-container-lowest px-margin-mobile md:px-margin-desktop border-b border-outline-variant shadow-sm">
            <div class="max-w-[1280px] w-full h-16 flex items-center justify-between gap-gutter">
                <!-- Brand Logo -->
                <div class="flex items-center gap-xs shrink-0">
                    <a href="/">
                        <img alt="Yakin Tri Medika Logo" class="h-10 w-auto" src="/img/ytm.jpeg" />
                    </a>
                </div>
                <!-- Category Links -->
                <nav class="hidden lg:flex items-center gap-md">
                    <a class="text-primary border-b-2 border-primary pb-1 font-label-md text-label-md transition-all duration-200"
                        href="#">All</a>
                    <a class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors duration-200"
                        href="#">Cats</a>
                    <a class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors duration-200"
                        href="#">Livestock</a>
                    <a class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors duration-200"
                        href="#">Poultry</a>
                    <a class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors duration-200"
                        href="#">Birds</a>
                    <a class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors duration-200"
                        href="#">Aqua</a>
                </nav>
                <!-- Desktop Search (On Left variant handled via layout) -->
                <div
                    class="hidden md:flex flex-1 max-w-md items-center bg-surface-container-low rounded-full px-sm py-1.5 border border-outline-variant">
                    <span class="material-symbols-outlined text-outline">search</span>
                    <input class="bg-transparent border-none focus:ring-0 text-body-md w-full ml-xs"
                        placeholder="Search medication, brands..." type="text" />
                </div>
                <!-- Actions -->
                <div class="flex items-center gap-sm">
                    <button
                        class="material-symbols-outlined text-outline hover:text-primary transition-colors">upload_file</button>
                    <button
                        class="material-symbols-outlined text-outline hover:text-primary transition-colors">chat</button>
                    <div class="relative">
                        <button
                            class="material-symbols-outlined text-outline hover:text-primary transition-colors">shopping_cart</button>
                        <span
                            class="absolute -top-1 -right-1 bg-secondary-container text-on-secondary-container text-[10px] px-1 rounded-full font-bold">2</span>
                    </div>
                    <div
                        class="h-8 w-8 rounded-full bg-surface-container-high flex items-center justify-center overflow-hidden border border-outline-variant">
                        <span class="material-symbols-outlined text-outline">person</span>
                    </div>
                </div>
            </div>
        </header>
    @else
        <header
            class="sticky top-0 w-full z-50 flex flex-col items-center bg-surface-container-lowest shadow-sm border-b border-outline-variant">
            <div class="max-w-[1280px] w-full px-margin-mobile md:px-margin-desktop py-xs flex items-center gap-md">
                <!-- Brand Logo -->
                <a class="flex-shrink-0" href="/">
                    <img alt="PT Yakin Tri Medika Logo" class="h-10 md:h-12 w-auto object-contain"
                        src="/img/ytm.jpeg" />
                </a>
                <button
                    class="hidden lg:flex items-center gap-xs font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors">
                    Kategori
                </button>
                <!-- Search Bar (on_left configuration) -->
                <div class="flex-grow max-w-2xl relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="material-symbols-outlined text-outline">search</span>
                    </div>
                    <input
                        class="w-full pl-10 pr-4 py-2 bg-surface-container-low border border-outline-variant rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary text-body-md font-body-md transition-all"
                        placeholder="Cari di Yakin Tri Medika" type="text" />
                </div>
                <!-- Trailing Actions -->
                <div class="flex items-center gap-sm md:gap-md">
                    <button
                        class="relative p-2 text-on-surface-variant hover:text-primary transition-all active:scale-95">
                        <span class="material-symbols-outlined" data-icon="shopping_cart">shopping_cart</span>
                        <span
                            class="absolute top-1 right-1 bg-secondary text-white text-[10px] px-1 rounded-full">3</span>
                    </button>
                    <button
                        class="relative p-2 text-on-surface-variant hover:text-primary transition-all active:scale-95">
                        <span class="material-symbols-outlined" data-icon="chat">chat</span>
                    </button>
                    <div class="h-8 w-px bg-outline-variant hidden md:block"></div>
                    <button
                        class="hidden md:flex items-center gap-2 px-4 py-1.5 border border-primary text-primary rounded-lg font-label-md text-label-md hover:bg-primary-container hover:text-on-primary-container transition-all">
                        Masuk
                    </button>
                    <button
                        class="hidden md:block px-4 py-1.5 bg-primary text-white rounded-lg font-label-md text-label-md hover:opacity-90 shadow-sm transition-all active:scale-95">
                        Daftar
                    </button>
                    <button class="p-2 text-on-surface-variant md:hidden">
                        <span class="material-symbols-outlined" data-icon="person">person</span>
                    </button>
                </div>
            </div>
            <!-- Navigation Links (Mobile/Desktop Sub-nav) -->
            <div class="w-full bg-surface-container-lowest hidden md:flex justify-center py-2">
                <nav class="max-w-[1280px] w-full px-margin-desktop flex gap-lg overflow-x-auto hide-scrollbar">
                    <a class="text-primary border-b-2 border-primary pb-1 font-label-md text-label-md whitespace-nowrap"
                        href="#">All</a>
                    <a class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors whitespace-nowrap"
                        href="#">Cats</a>
                    <a class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors whitespace-nowrap"
                        href="#">Livestock</a>
                    <a class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors whitespace-nowrap"
                        href="#">Poultry</a>
                    <a class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors whitespace-nowrap"
                        href="#">Birds</a>
                    <a class="text-on-surface-variant font-label-md text-label-md hover:text-primary transition-colors whitespace-nowrap"
                        href="#">Aqua</a>
                </nav>
            </div>
        </header>
    @endif

    @yield('content')

    <!-- Footer Shell -->
    <footer
        class="w-full py-lg px-margin-mobile md:px-margin-desktop grid grid-cols-1 md:grid-cols-4 gap-gutter bg-surface-container-low border-t border-outline-variant">
        <div class="flex flex-col gap-sm">
            <img alt="PT Yakin Tri Medika Logo" class="h-12 w-fit grayscale opacity-70 mb-2"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBd7NndiBIc6SBrftqqwkJh6EsYWW02LqUcKyJTwIxtVz7g1KrOcNofRLf8KN2tY7JmUSdZ8141ROyXqANVl6mQZ-WPgdCH4NFrRRxkSr9Rh1vR1GNTawfqV3DuvNqdS_d7bQnnZUTVuG-FSygS2ztZyPUbSppgJ7RrjlodO8RorslP5jgKuKj1xheEM_CMdsH07e9H-syA8gfilvnSjSe7DXLXu0rJ0KRMO2u4PmTa0C9a6qckDVQEgHZdqwC8_T2OaTc" />
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
        searchInput.addEventListener('focus', () => {
            searchInput.parentElement.classList.add('scale-[1.01]');
        });
        searchInput.addEventListener('blur', () => {
            searchInput.parentElement.classList.remove('scale-[1.01]');
        });
    </script>
    @stack('script')
</body>

</html>
