<!DOCTYPE html>
<html>
<head>
    <title>Admin - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#10b981">
    <meta name="description" content="Sistem Manajemen Yayasan Sosial Indonesia">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Yayasan Admin">
    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" href="/images/icon-192.svg">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" rel="stylesheet" />
 @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-sm">

<style>
    /* Collapsed sidebar styles when body has .sidebar-collapsed */
    .sidebar-main { transition: width 200ms ease; overflow-x: visible; }
    .sidebar-main .nav-text, .sidebar-main .brand-text { transition: opacity 180ms ease, transform 180ms ease; }
    .sidebar-collapsed .sidebar-main { width: 76px; }
    .sidebar-collapsed .sidebar-main .nav-text { opacity: 0; transform: translateX(-6px); pointer-events: none; }
    .sidebar-collapsed .sidebar-main .brand-text { opacity: 0; transform: translateX(-6px); }
    .sidebar-collapsed .sidebar-main .w-9 { width: 36px; height: 36px; }
    @media (max-width: 767px) {
        .sidebar-collapsed .sidebar-main { position: relative; width: 100% }
        .sidebar-collapsed .sidebar-main .nav-text { display: inline }
    }

    /* Nav tooltips (hidden by default since collapse feature removed) */
    .nav-tooltip { display: none; }
    /* Page header helper: keep header above scrollable content */
    .page-header { position: sticky; top: 0; z-index: 30; background: transparent; }
    .page-header .header-inner { background: transparent; }
    /* Hide visible scrollbars on the sidebar but keep scrolling functional */
    .sidebar-main::-webkit-scrollbar { width: 0; height: 0; }
    .sidebar-main { -ms-overflow-style: none; scrollbar-width: none; }

    /* Top bar user dropdown styles */
    .user-dropdown {
        position: relative;
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 14px;
    }

    .dropdown-menu {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1), 0 4px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
    }

    .dropdown-arrow {
        transition: transform 0.2s ease;
    }

    .dropdown-arrow.rotate-180 {
        transform: rotate(180deg);
    }
</style>
</style>

<div class="flex min-h-screen text-sm">

    <!-- Sidebar -->
    <aside class="sidebar-main w-56 md:w-64 bg-slate-800 text-slate-100 p-3 md:p-4 shadow-lg md:fixed md:inset-y-0 md:left-0 md:h-screen md:overflow-y-auto z-20">
        <div class="relative flex items-center gap-2 px-1 py-2 mb-5">
            <div class="flex items-center gap-2 relative">
                <div class="w-9 h-9 bg-blue-600 rounded flex items-center justify-center text-white font-semibold text-sm">Y</div>
                <div>
                    <div class="brand-text font-semibold text-sm">Company</div>
                    <div class="brand-text text-[11px] text-slate-400">Admin Panel</div>
                </div>
                
            </div>
        </div>

        <nav class="space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="relative flex items-center gap-2 px-2 py-2 rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800' : 'hover:bg-slate-900' }}">
                <span class="material-symbols-outlined text-slate-300 text-[18px]">dashboard</span>
                <span class="nav-text text-sm">Dashboard</span>
                <span class="nav-tooltip absolute left-full ml-3 top-1/2 -translate-y-1/2 whitespace-nowrap rounded bg-slate-800 text-white text-xs px-2 py-1 opacity-0 pointer-events-none">Dashboard</span>
            </a>
            <a href="{{ route('admin.landing-sections.index') }}" class="relative flex items-center gap-2 px-2 py-2 rounded-md {{ request()->routeIs('admin.landing-sections*') ? 'bg-slate-800' : 'hover:bg-slate-900' }}">
                <span class="material-symbols-outlined text-slate-300 text-[18px]">web</span>
                <span class="nav-text text-sm">Landing Page</span>
                <span class="nav-tooltip absolute left-full ml-3 top-1/2 -translate-y-1/2 whitespace-nowrap rounded bg-slate-800 text-white text-xs px-2 py-1 opacity-0 pointer-events-none">Landing Page</span>
            </a>

            <a href="{{ route('admin.menus.index') }}" class="relative flex items-center gap-2 px-2 py-2 rounded-md {{ request()->routeIs('admin.menus*') ? 'bg-slate-800' : 'hover:bg-slate-900' }}">
                <span class="material-symbols-outlined text-slate-300 text-[18px]">menu</span>
                <span class="nav-text text-sm">Menu Navbar</span>
                <span class="nav-tooltip absolute left-full ml-3 top-1/2 -translate-y-1/2 whitespace-nowrap rounded bg-slate-800 text-white text-xs px-2 py-1 opacity-0 pointer-events-none">Menu Navbar</span>
            </a>

            <a href="{{ route('admin.pages.index') }}" class="relative flex items-center gap-2 px-2 py-2 rounded-md {{ request()->routeIs('admin.pages*') ? 'bg-slate-800' : 'hover:bg-slate-900' }}">
                <span class="material-symbols-outlined text-slate-300 text-[18px]">article</span>
                <span class="nav-text text-sm">Halaman Statis</span>
                <span class="nav-tooltip absolute left-full ml-3 top-1/2 -translate-y-1/2 whitespace-nowrap rounded bg-slate-800 text-white text-xs px-2 py-1 opacity-0 pointer-events-none">Halaman Statis</span>
            </a>

            <a href="{{ route('admin.produk.index') }}" class="relative flex items-center gap-2 px-2 py-2 rounded-md {{ request()->routeIs('admin.produk*') ? 'bg-slate-800' : 'hover:bg-slate-900' }}">
                <span class="material-symbols-outlined text-slate-300 text-[18px]">rss_feed</span>
                <span class="nav-text text-sm">Produk</span>
                <span class="nav-tooltip absolute left-full ml-3 top-1/2 -translate-y-1/2 whitespace-nowrap rounded bg-slate-800 text-white text-xs px-2 py-1 opacity-0 pointer-events-none">Produk</span>
            </a>

            <a href="{{ route('admin.settings.index') }}" class="relative flex items-center gap-2 px-2 py-2 rounded-md {{ request()->routeIs('admin.settings*') ? 'bg-slate-800' : 'hover:bg-slate-900' }}">
                <span class="material-symbols-outlined text-slate-300 text-[18px]">settings</span>
                <span class="nav-text text-sm">Pengaturan</span>
                <span class="nav-tooltip absolute left-full ml-3 top-1/2 -translate-y-1/2 whitespace-nowrap rounded bg-slate-800 text-white text-xs px-2 py-1 opacity-0 pointer-events-none">Pengaturan</span>
            </a>
        </nav>
    </aside>

    <!-- external toggle removed; toggle now inside brand area -->

    <!-- Content -->
    <main class="flex-1 md:ml-64 h-screen flex flex-col">
        <!-- Top Bar with User Info -->
        <header class="bg-white shadow-sm border-b border-gray-200 px-2 py-1 flex-shrink-0">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <!-- Mobile menu toggle (if needed) -->
                    <button class="md:hidden p-2 rounded-md hover:bg-gray-100" id="mobileMenuToggle">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    
                    <!-- Page title (can be overridden by pages) -->
                    <div id="pageTitle" class="hidden md:block">
                        @yield('page-title')
                    </div>
                </div>

                <!-- User Info Section -->
                <div class="flex items-center gap-4">
                    <!-- Current Date & Time -->
                    <div class="hidden md:flex items-center gap-2 text-sm text-gray-600">
                        <span class="material-symbols-outlined text-gray-400">schedule</span>
                        <span id="currentDateTime"></span>
                    </div>

                    <!-- User Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                            <!-- User Avatar -->
                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            
                            <!-- User Info -->
                            <div class="hidden md:block text-left">
                                <div class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                            </div>
                            
                            <!-- Dropdown Arrow -->
                            <span class="material-symbols-outlined text-gray-400 transition-transform" :class="{'rotate-180': open}">expand_more</span>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                            <!-- User Info Header -->
                            <div class="px-4 py-3 border-b border-gray-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</div>
                                        <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Menu Items -->
                            <div class="py-1">
                                <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                    <span class="material-symbols-outlined text-gray-400">person</span>
                                    Profile
                                </a>
                                
                                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                    <span class="material-symbols-outlined text-gray-400">settings</span>
                                    Pengaturan
                                </a>
                                
                                <div class="border-t border-gray-200 my-1"></div>
                                
                                <form method="POST" action="{{ route('logout') }}" class="px-4 py-1">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-3 w-full px-2 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors rounded">
                                        <span class="material-symbols-outlined">logout</span>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Optional additional topbar area (pages can define a section 'topbar' or use an element with class 'page-header') -->
        <div class="flex-shrink-0" id="pageTopbar">
            @yield('topbar')
        </div>

        <!-- Scrollable content area (will not scroll under the topbar) -->
        <div class="flex-1 overflow-auto">
            <div class="p-6">
                @yield('content')
            </div>
        </div>
    </main>
</div>

<script>
    // Collapse/hide feature removed; no toggle script required

    // Real-time clock
    function updateDateTime() {
        const now = new Date();
        const options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        };
        document.getElementById('currentDateTime').textContent = now.toLocaleDateString('id-ID', options);
    }

    // Update time every second
    updateDateTime();
    setInterval(updateDateTime, 1000);

    // Mobile menu toggle (if needed)
    document.getElementById('mobileMenuToggle')?.addEventListener('click', function() {
        // Add mobile menu functionality if needed
        console.log('Mobile menu toggle clicked');
    });

    // Register Service Worker for PWA
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/sw.js')
                .then(function(registration) {
                    console.log('Service Worker registered successfully:', registration.scope);
                })
                .catch(function(error) {
                    console.log('Service Worker registration failed:', error);
                });
        });
    }
</script>
@stack('scripts')
</body>
</html>
