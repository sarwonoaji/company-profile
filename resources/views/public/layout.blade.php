<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Web')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- SEO BASIC --}}
    <meta name="description" content="@yield('Website resmi yayasan')">
    <meta name="mobile-web-app-capable" content="yes">
    
    {{-- AOS (Animate On Scroll) --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    
    <style>
        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Navbar transition */
        header {
            transition: all 0.3s ease;
        }

        /* Button hover effects */
        .btn-primary {
            @apply inline-block px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold transition-all duration-300 hover:bg-blue-700 hover:shadow-lg hover:-translate-y-0.5;
        }

        .btn-secondary {
            @apply inline-block px-6 py-3 border-2 border-blue-600 text-blue-600 rounded-lg font-semibold transition-all duration-300 hover:bg-blue-50 hover:shadow-lg;
        }

        /* Card hover effect */
        .card-hover {
            @apply transition-all duration-300 hover:shadow-xl hover:-translate-y-1;
        }

        /* Gradient text */
        .gradient-text {
            @apply bg-gradient-to-r from-blue-600 to-blue-700 bg-clip-text text-transparent;
        }

        /* Modal Styles */
        .modal-overlay {
            @apply fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 transition-all duration-300;
            opacity: 0;
            pointer-events: none;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .modal {
            @apply bg-white rounded-2xl shadow-2xl max-w-lg w-full mx-4 transform transition-all duration-300;
            scale: 0.95;
        }

        .modal-overlay.active .modal {
            scale: 1;
        }

        .modal-header {
            @apply px-8 py-6 border-b border-gray-200 flex items-center justify-between;
        }

        .modal-body {
            @apply px-8 py-6;
        }

        .modal-footer {
            @apply px-8 py-4 border-t border-gray-200 flex gap-3 justify-end;
        }

        .modal-close {
            @apply text-gray-400 hover:text-gray-600 cursor-pointer transition-colors;
        }

        /* Loading Animation */
        .loading-spinner {
            @apply inline-block;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .loading-dots {
            @apply inline-flex gap-1;
        }

        .loading-dots span {
            @apply w-2 h-2 bg-current rounded-full;
            animation: bounce 1.4s infinite;
        }

        .loading-dots span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .loading-dots span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes bounce {
            0%, 80%, 100% { transform: scale(0.8); opacity: 0.5; }
            40% { transform: scale(1); opacity: 1; }
        }

        /* Skeleton Loading */
        .skeleton {
            @apply bg-gradient-to-r from-gray-200 to-gray-300 rounded-lg;
            animation: skeleton-loading 1s infinite alternate;
        }

        @keyframes skeleton-loading {
            0% { background-color: hsl(200, 20%, 80%); }
            100% { background-color: hsl(200, 20%, 95%); }
        }

        /* Pagination Styles */
        .pagination {
            @apply flex items-center justify-center gap-1 mt-12;
        }

        .pagination a,
        .pagination span {
            @apply px-3 py-2 rounded-lg transition-all duration-300;
        }

        .pagination a {
            @apply text-gray-700 hover:bg-blue-50 hover:text-blue-600 border border-gray-200 hover:border-blue-300;
        }

        .pagination .active span {
            @apply bg-blue-600 text-white border-blue-600 font-semibold;
        }

        .pagination .disabled span {
            @apply text-gray-400 cursor-not-allowed;
        }

        /* Page Transition */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        main {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900 leading-relaxed">

    {{-- NAVBAR --}}
    @php
        $settings = \App\Models\Setting::first();
        $menus = \App\Models\Menu::active()->get();
    @endphp

    <header class="bg-white border-b border-gray-100 sticky top-0 z-50 backdrop-blur-sm bg-opacity-95">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center gap-2 hover:opacity-80 transition">
                @if($settings && $settings->logo)
                <img src="{{ asset('img/logo/'.$settings->logo) }}" alt="Logo" class="h-10 w-auto">
                @else
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                @endif
                <span class="font-bold text-2xl bg-gradient-to-r from-blue-500 to-blue-700 bg-clip-text text-transparent">
                {{ $settings->site_name ?? 'Web' }}
            </span>
            </a>

            <nav class="space-x-1 hidden md:flex">
                @forelse($menus as $menu)
                    <a href="{{ $menu->url }}" class="px-3 py-2 rounded-lg text-gray-700 font-medium transition-all duration-300 hover:bg-blue-50 hover:text-blue-600">
                        {{ $menu->title }}
                    </a>
                @empty
                    <span class="text-gray-500">Belum ada menu</span>
                @endforelse
            </nav>

            {{-- Mobile Menu Button --}}
            <button class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition" id="mobileMenuBtn">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-100">
            <div class="container mx-auto px-4 py-3 space-y-1">
                @forelse($menus as $menu)
                    <a href="{{ $menu->url }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-300">
                        {{ $menu->title }}
                    </a>
                @empty
                    <span class="text-gray-500 block py-2">Belum ada menu</span>
                @endforelse
            </div>
        </div>
    </header>

    <script>
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });
    </script>

    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gradient-to-br from-slate-900 to-slate-800 text-gray-300 mt-20 border-t-4 border-blue-600 relative">
        <!-- Decorative top line -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-blue-500 to-transparent"></div>
        
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div data-aos="fade-up">
                    <div class="flex items-center gap-3 mb-3">
                        @if($settings && $settings->logo)
                            <img src="{{ asset('img/logo/' . $settings->logo) }}" alt="Logo" class="h-12 w-auto">
                        @else
                            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        @endif
                        @unless($settings && $settings->logo)
                            <h3 class="font-bold text-white text-lg text-blue-400">{{ $settings->site_name ?? 'Website' }}</h3>
                        @endunless
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Website resmi jasa pembuatan website yang berdedikasi menghadirkan solusi digital profesional, modern, dan berkualitas untuk membantu bisnis berkembang lebih cepat di era digital.
                    </p>
                    @if($settings && ($settings->facebook || $settings->instagram || $settings->youtube))
                    <div class="flex gap-3 mt-4">
                        @if($settings->facebook)
                        <a href="{{ $settings->facebook }}" target="_blank" class="w-10 h-10 rounded-full bg-slate-700 hover:bg-blue-600 flex items-center justify-center transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        @endif
                        @if($settings->instagram)
                        <a href="{{ $settings->instagram }}" target="_blank" class="w-10 h-10 rounded-full bg-slate-700 hover:bg-pink-600 flex items-center justify-center transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm4.441 15.892c0 2.297-1.852 4.157-4.157 4.157H11.716c-2.305 0-4.157-1.86-4.157-4.157V11.716c0-2.305 1.852-4.157 4.157-4.157h.568c2.305 0 4.157 1.852 4.157 4.157v4.176z"/></svg>
                        </a>
                        @endif
                        @if($settings->youtube)
                        <a href="{{ $settings->youtube }}" target="_blank" class="w-10 h-10 rounded-full bg-slate-700 hover:bg-red-600 flex items-center justify-center transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        @endif
                    </div>
                    @endif
                </div>

                <div data-aos="fade-up" data-aos-delay="200" class="border-l-2 border-blue-600 pl-6 md:border-l-2 md:pl-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-white text-lg">Kontak Kami</h3>
                    </div>
                    @if($settings)
                        @if($settings->address)
                        <p class="text-sm text-gray-400 mb-3 flex items-start gap-2">
                            <span class="text-blue-400 mt-1">📍</span>
                            <span>{{ $settings->address }}</span>
                        </p>
                        @endif
                        @if($settings->phone)
                        <p class="text-sm text-gray-400 mb-3 flex items-center gap-2">
                            <span class="text-blue-400">📞</span>
                            <a href="tel:{{ $settings->phone }}" class="hover:text-blue-400 transition-colors duration-300">{{ $settings->phone }}</a>
                        </p>
                        @endif
                        @if($settings->email)
                        <p class="text-sm text-gray-400 flex items-center gap-2">
                            <span class="text-blue-400">✉️</span>
                            <a href="mailto:{{ $settings->email }}" class="hover:text-blue-400 transition-colors duration-300">{{ $settings->email }}</a>
                        </p>
                        @endif
                    @endif
                </div>
            </div>

            <div class="border-t-2 border-blue-600 pt-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-center md:text-left">
                    <p class="text-sm text-gray-400">
                        © {{ date('Y') }} 
                        @if($settings && $settings->logo)
                            <img src="{{ asset('img/logo/'.$settings->logo) }}" alt="Logo" class="inline h-4 w-auto align-middle" />
                        @else
                            <span class="text-blue-400 font-semibold">{{ $settings->site_name ?? 'Yayasan' }}</span>
                        @endif
                        . All rights reserved.
                    </p>
                    
                </div>
            </div>
        </div>
    </footer>

    {{-- AOS Script --}}
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: false,
            offset: 100
        });

        // Modal Handler
        window.Modal = {
            open(id) {
                const modal = document.getElementById(id);
                if (modal) {
                    modal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            },
            close(id) {
                const modal = document.getElementById(id);
                if (modal) {
                    modal.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }
            }
        };

        // Close modal on overlay click
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) {
                    overlay.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }
            });
        });

        // Close modal on close button
        document.querySelectorAll('.modal-close').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const modal = e.target.closest('.modal-overlay');
                if (modal) {
                    modal.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }
            });
        });

        // Loading state for forms
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const btn = this.querySelector('button[type="submit"]');
                if (btn) {
                    btn.disabled = true;
                    btn.innerHTML = '<span class="loading-dots"><span></span><span></span><span></span></span> Memproses...';
                }
            });
        });

        // Show loading spinner on page change (pagination/navigation)
        document.addEventListener('click', function(e) {
            if (e.target.tagName === 'A' && !e.target.target) {
                const href = e.target.href;
                if (href && href.includes(window.location.origin)) {
                    // Show page loading indicator if needed
                }
            }
        });
    </script>

    {{-- Reusable Modal Example --}}
    @if(session('success') || session('error') || $errors->any())
    <div id="alertModal" class="modal-overlay active">
        <div class="modal">
            <div class="modal-header">
                <h3 class="text-lg font-semibold">{{ session('success') ? 'Sukses' : (session('error') ? 'Error' : 'Validasi') }}</h3>
                <span class="modal-close">&times;</span>
            </div>
            <div class="modal-body">
                @if(session('success'))
                    <p class="text-gray-700">{{ session('success') }}</p>
                @elseif(session('error'))
                    <p class="text-gray-700">{{ session('error') }}</p>
                @else
                    <ul class="list-disc list-inside text-red-600 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" onclick="Modal.close('alertModal')" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-300">
                    Tutup
                </button>
            </div>
        </div>
    </div>
    @endif

    @stack('scripts')
    <script>
        // Disable right-click context menu
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        // Disable common DevTools shortcuts: F12, Ctrl+Shift+I/J, Ctrl+U
        document.addEventListener('keydown', function(e) {
            try {
                const key = (e.key || '').toString().toLowerCase();
                if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && (key === 'i' || key === 'j')) || (e.ctrlKey && key === 'u')) {
                    e.preventDefault();
                    return false;
                }
            } catch (err) {
                // ignore
            }
        });
    </script>
</body>
</html>