<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Login | PT Yakin Tri Medika</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('img/ytm.jpeg') }}">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary-fixed-dim": "#6bd8cb",
                        "inverse-primary": "#6bd8cb",
                        "surface-variant": "#d5e3fd",
                        "on-secondary-container": "#5c2400",
                        "tertiary-container": "#737575",
                        "surface-container-highest": "#d5e3fd",
                        "tertiary-fixed": "#e2e2e2",
                        "on-primary": "#ffffff",
                        "secondary-fixed": "#ffdbca",
                        "surface": "#f8f9ff",
                        "on-background": "#0d1c2f",
                        "on-secondary": "#ffffff",
                        "on-surface-variant": "#3d4947",
                        "on-error": "#ffffff",
                        "background": "#f8f9ff",
                        "on-primary-fixed-variant": "#005049",
                        "primary-container": "#008378",
                        "surface-bright": "#f8f9ff",
                        "secondary-container": "#fd761a",
                        "on-tertiary-fixed": "#1a1c1c",
                        "on-surface": "#0d1c2f",
                        "primary-fixed": "#89f5e7",
                        "tertiary": "#5a5c5c",
                        "on-tertiary-fixed-variant": "#454747",
                        "on-primary-fixed": "#00201d",
                        "on-primary-container": "#f4fffc",
                        "error": "#ba1a1a",
                        "surface-dim": "#ccdbf4",
                        "inverse-on-surface": "#ebf1ff",
                        "inverse-surface": "#233144",
                        "on-tertiary-container": "#fcfcfc",
                        "on-secondary-fixed": "#341100",
                        "surface-container": "#e6eeff",
                        "primary": "#00685f",
                        "surface-container-high": "#dde9ff",
                        "on-tertiary": "#ffffff",
                        "surface-tint": "#006a61",
                        "secondary": "#9d4300",
                        "outline": "#6d7a77",
                        "tertiary-fixed-dim": "#c6c6c7",
                        "surface-container-low": "#eff4ff",
                        "outline-variant": "#bcc9c6",
                        "surface-container-lowest": "#ffffff",
                        "secondary-fixed-dim": "#ffb690",
                        "on-secondary-fixed-variant": "#783200",
                        "on-error-container": "#93000a",
                        "error-container": "#ffdad6",
                        "ytm-teal": "#0D9488",
                        "ytm-coral": "#F97316",
                        "ytm-coral-hover": "#EA580C"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "xs": "8px",
                        "margin-mobile": "16px",
                        "margin-desktop": "64px",
                        "lg": "48px",
                        "gutter": "24px",
                        "xl": "80px",
                        "md": "24px",
                        "base": "4px",
                        "sm": "16px"
                    },
                    "fontFamily": {
                        "display-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "headline-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "label-md": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "headline-lg": ["Inter"],
                        "caption": ["Inter"]
                    },
                    "fontSize": {
                        "display-lg": ["48px", {
                            "lineHeight": "56px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
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
                        "label-md": ["14px", {
                            "lineHeight": "20px",
                            "fontWeight": "600"
                        }],
                        "headline-lg-mobile": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "600"
                        }],
                        "headline-lg": ["32px", {
                            "lineHeight": "40px",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
                        }],
                        "caption": ["12px", {
                            "lineHeight": "16px",
                            "fontWeight": "400"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9ff;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .coral-btn {
            background-color: #F97316;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .coral-btn:hover {
            background-color: #EA580C;
            transform: translateY(-1px);
        }

        .input-focus:focus-within {
            border-color: #0D9488;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">
    <div class="flex-grow flex">
        <!-- Left Side: Split Image (Desktop Only) -->
        <div class="hidden lg:block lg:w-1/2 relative overflow-hidden">
            <img alt="Professional healthcare services" class="absolute inset-0 w-full h-full object-cover"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDI7vETBVkrI_sy7C-CeTdLOekm1HH6GONxlOSNiLdkwYODQOFUaPt0TQhsfAu6U4ot9O_UtLF1MmYos5SWAu7yJgCiYaMJqpit6wSH-UXghY1LzTBNZ3ETQ86_M4Auq1NUYMC2enELqXxPNN3ESh9xbeUArLRCzIusis2Iw7UpdH-u_teEBJyBRQ9NIGtg-fCVLwD0V6TXWyCykVi_P_IvxNOlVdYkcE7Ft6rYx1A6TTyjzfHB3VRi3Q" />
            <!-- Brand Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-ytm-teal/40 to-transparent mix-blend-multiply"></div>
            <div class="absolute bottom-xl left-xl right-xl z-20 text-white">
                <div class="flex items-center gap-sm mb-sm">
                    <img alt="PT Yakin Tri Medika Logo" class="h-16 w-auto brightness-0 invert"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuA7KM_Up0GTmnyrKwMiTkYb1Qn3xqRtS4G_-UcF9qDorIdMkBUqDnv_yMRV2jXp_e4FH5I4XENUYIv5gTkgeYzk9dKpos5Yq-snPVCQFzsd-uiNLu2hcQARAtK3gGX3rm8HfpZUlTSWrf8twI5nZTuNBKakf2OGXusM3AjCQ4RKDKqx-fyd9H1QwYsYO7pl3B0h-qR052q1DsWbHQtmPPm1i0EUhXo5lQbpwlV0w1OyrdxnNWEh91F_7F1H6Fj-AwinFwk" />
                </div>
                <p class="text-body-lg max-w-md opacity-90">Your trusted partner in healthcare solutions, providing
                    professional medical equipment and supplies with integrity and care.</p>
            </div>
        </div>
        <!-- Right Side: Login Container -->
        <div class="w-full lg:w-1/2 flex flex-col bg-white">
            <!-- Mobile/Small Desktop Header -->
            <header
                class="w-full flex items-center justify-between px-margin-mobile md:px-margin-desktop py-md lg:hidden">
                <div class="flex items-center">
                    <img alt="PT Yakin Tri Medika Logo" class="h-10 w-auto"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCd8lkp-ZgD2JlfM9cGfDDVukc0qvGyTPdq7_UILl435czuMYkgTDRJS1EYBeh6OSDfsUzlED7bUOLl0tDoVfqB6pIq06b3xfJ5t-bNMxHY7DXW1Gept1R5tSFe5fUae-J2xSP8b_9UzlQAYZq5jNcd3x0FndWPDHGhOZs8FF02Mh7e8LEomUQ07D3FxvirKQXGBknN-dTU1kcOJ4yBqY-76Xs_gxfAQxL7RRg0_7T6DWRDna7OodGG1_Sdn8AN1WExd20" />
                </div>
                <a class="font-label-md text-label-md text-on-surface-variant hover:text-ytm-teal transition-colors flex items-center gap-base"
                    href="#">
                    <span class="material-symbols-outlined text-sm">help</span>
                    Support
                </a>
            </header>
            <main class="flex-grow flex items-center justify-center p-margin-mobile md:p-xl">
                <div class="w-full max-w-[440px] flex flex-col">
                    <div class="mb-lg">
                        <h1 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Welcome Back</h1>
                        <p class="font-body-md text-body-md text-on-surface-variant">Sign in to your PT Yakin Tri Medika
                            account</p>
                    </div>
                    <!-- Login Form -->
                    @if ($errors->any())
                        <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-4 text-sm font-semibold">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-4 text-sm font-semibold">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form class="space-y-md" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="space-y-xs">
                            <label class="font-label-md text-label-md text-on-surface block" for="email">Email
                                Address</label>
                            <div
                                class="relative input-focus border border-outline-variant rounded-lg bg-white overflow-hidden transition-all duration-200">
                                <span
                                    class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant text-body-md">mail</span>
                                <input
                                    class="w-full pl-11 pr-sm py-3 border-none focus:ring-0 text-body-md font-body-md placeholder:text-outline-variant"
                                    id="email" name="email" value="{{ old('email') }}"
                                    placeholder="e.g. employee@yakintrimedika.com" type="email" required />
                            </div>
                        </div>
                        <div class="space-y-xs">
                            <div class="flex justify-between items-center">
                                <label class="font-label-md text-label-md text-on-surface block"
                                    for="password">Password</label>
                                <a class="text-caption font-label-md text-ytm-teal hover:underline"
                                    href="#">Forgot Password?</a>
                            </div>
                            <div
                                class="relative input-focus border border-outline-variant rounded-lg bg-white overflow-hidden transition-all duration-200">
                                <span
                                    class="material-symbols-outlined absolute left-sm top-1/2 -translate-y-1/2 text-on-surface-variant text-body-md">lock</span>
                                <input
                                    class="w-full pl-11 pr-11 py-3 border-none focus:ring-0 text-body-md font-body-md placeholder:text-outline-variant"
                                    id="password" name="password" placeholder="••••••••" type="password" required />
                                <button
                                    class="absolute right-sm top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-ytm-teal transition-colors"
                                    type="button">
                                    <span class="material-symbols-outlined text-body-md">visibility</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center gap-xs pt-base">
                            <input class="w-4 h-4 rounded border-outline-variant text-ytm-teal focus:ring-ytm-teal"
                                id="remember" name="remember" type="checkbox" />
                            <label class="font-body-md text-body-md text-on-surface-variant cursor-pointer"
                                for="remember">Remember me for 30 days</label>
                        </div>
                        <button
                            class="coral-btn w-full py-3.5 rounded-lg text-white font-label-md text-label-md mt-sm flex items-center justify-center gap-sm shadow-lg shadow-ytm-coral/20"
                            type="submit">
                            Login
                            <span class="material-symbols-outlined text-md">arrow_forward</span>
                        </button>
                    </form>
                    <!-- Divider -->
                    <div class="flex items-center gap-sm my-lg">
                        <div class="flex-grow h-[1px] bg-outline-variant"></div>
                        <span class="text-[10px] font-bold text-outline uppercase tracking-widest">OR CONTINUE
                            WITH</span>
                        <div class="flex-grow h-[1px] bg-outline-variant"></div>
                    </div>
                    <!-- Social Logins -->
                    <div class="grid grid-cols-2 gap-sm">
                        <button
                            class="flex items-center justify-center gap-xs py-3 px-sm border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors font-label-md text-label-md text-on-surface">
                            <img alt="Google" class="w-5 h-5"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBGWQe9WTN9hCfmegm6JoBCRzmH5jM1ik9HnH2MQS9HTXgJFYD2NKLHCQQVTuarydHQRQ2ctvrN-n4BMPxrhDz9aO0_y_XV07P_gOvHiCk7FbeS1ojpdomBp1LgKDNeagnI8hKawKqJTh-dUcQEHpblyor-dGn_LeTq1UkYb4ChGuVtyGvJ5SjNCxZ8PihrQSMpascfTGOeUflh8-cXH01hfylo11v_5Spy53lQ70IffsFuCWrNpy59cQ" />
                            Google
                        </button>
                        <button
                            class="flex items-center justify-center gap-xs py-3 px-sm border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors font-label-md text-label-md text-on-surface">
                            <span class="material-symbols-outlined text-lg"
                                style="font-variation-settings: 'FILL' 1;">apps</span>
                            Apple
                        </button>
                    </div>
                    <!-- Signup Redirect -->
                    <div class="mt-xl text-center">
                        <p class="font-body-md text-body-md text-on-surface-variant">
                            New to PT Yakin Tri Medika?
                            <a class="text-ytm-teal font-label-md hover:underline" href="/register">Create an
                                Account</a>
                        </p>
                    </div>
                </div>
            </main>
            <!-- Support link for desktop split view -->
            <div class="hidden lg:flex justify-end p-md">
                <a class="font-label-md text-label-md text-on-surface-variant hover:text-ytm-teal transition-colors flex items-center gap-base"
                    href="#">
                    <span class="material-symbols-outlined text-sm">help</span>
                    Support
                </a>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer
        class="w-full py-lg px-margin-mobile md:px-margin-desktop bg-surface-container-low border-t border-outline-variant">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-md">
            <div class="flex flex-col items-center md:items-start gap-xs">
                <div class="flex items-center gap-xs opacity-80">
                    <img alt="PT Yakin Tri Medika Logo" class="h-8 w-auto"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBHg5XNjxdtxQpozx0bIFmdUDg_BhWzPQ2CU5j6fQE4ENSBH1d79SFcg9NguI9KKqctEyVcKZrkHyKN7DWet4CNq8ofoKWgZqAxQesppCwaWjTQ0wctXaPG0B0o3B6QFyuZG6Sh3ss4ZV0PPFJgGmsXir42wobJdfyax0LCTxVfKCv8gVgyZvXXx3jzQvdd9RdX4uQm6UxO-pVVgWGQmz20I7XBlghsMnnewEJqj-UF5afonufAVwaYyTSD_7lbfGNlo7c" />
                </div>
                <p class="text-caption font-caption text-on-surface-variant">© 2024 PT Yakin Tri Medika. All rights
                    reserved.</p>
            </div>
            <div class="flex flex-wrap justify-center gap-lg">
                <a class="text-caption font-label-md text-on-surface-variant hover:text-ytm-teal transition-colors"
                    href="#">Medical Licensing</a>
                <a class="text-caption font-label-md text-on-surface-variant hover:text-ytm-teal transition-colors"
                    href="#">Distribution Partners</a>
                <a class="text-caption font-label-md text-on-surface-variant hover:text-ytm-teal transition-colors"
                    href="#">Privacy Policy</a>
                <a class="text-caption font-label-md text-on-surface-variant hover:text-ytm-teal transition-colors"
                    href="#">Terms of Service</a>
            </div>
            <div class="flex items-center gap-md">
                <div class="flex flex-col items-end">
                    <span
                        class="text-[10px] font-bold text-error bg-error/10 px-2 py-0.5 rounded-full uppercase tracking-widest">Customer
                        Support</span>
                    <span class="font-label-md text-label-md text-on-surface">+62 21-YAKIN-MED</span>
                </div>
            </div>
        </div>
    </footer>
    <script>
        // Password visibility toggle
        const toggleBtn = document.querySelector('button[type="button"]');
        const passInput = document.getElementById('password');

        toggleBtn?.addEventListener('click', () => {
            const isPass = passInput.type === 'password';
            passInput.type = isPass ? 'text' : 'password';
            toggleBtn.children[0].textContent = isPass ? 'visibility_off' : 'visibility';
        });

        // Visual focus states
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', () => {
                input.closest('.input-focus')?.classList.add('ring-2', 'ring-ytm-teal/20');
            });
            input.addEventListener('blur', () => {
                input.closest('.input-focus')?.classList.remove('ring-2', 'ring-ytm-teal/20');
            });
        });
    </script>
</body>

</html>
