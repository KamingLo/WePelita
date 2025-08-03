<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pelita Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        #sidebar {
            width: 18rem;
        }
        
        #main-content {
            margin-left: 0;
        }
        
        @media (max-width: 1023px) {
            #main-content {
                padding-bottom: 20rem;
            }
        }
        
        @media (min-width: 1024px) {
            #main-content {
                margin-left: 18rem;
            }
            .sidebar-minimized #main-content {
                margin-left: 5rem;
            }
        }
        
        .sidebar-minimized #sidebar {
            width: 5rem;
        }
        
        .sidebar-minimized .sidebar-text {
            display: none;
        }
        
        /* Override sidebar-text hiding for mobile menu */
        @media (max-width: 1023px) {
            #mobile-menu .sidebar-text {
                display: block !important;
            }
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .nav-item {
            position: relative;
            overflow: hidden;
        }
        
        .nav-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .nav-item:hover::before {
            left: 100%;
        }
        
        .active-nav {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: #1f2937;
            box-shadow: 0 8px 32px rgba(251, 191, 36, 0.3);
        }
        
        .sidebar-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .floating-nav {
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        :root {
            --bg-dark: linear-gradient(135deg, #1e293b, #334155, #1e293b);
            --bg-light: #F0F4FF;
        }

        html.dark body {
            background: var(--bg-dark);
        }

        html.light body {
            background: var(--bg-light);
            position: relative;
        }

        html.light body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('/image/PatternLogo2.webp');
            background-repeat: repeat;
            background-position: center;
            background-size: 180px 180px;
            opacity: 0.05;
            z-index: -1;
        }

        html.dark body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('/image/PatternLogo2.webp');
            background-repeat: repeat;
            background-position: center;
            background-size: 180px 180px;
            opacity: 0.05;
            z-index: -1;
        }

        html.dark h1, html.dark h4, html.dark h5, html.dark h6 {
            color: #ffffff;
        }

        html.dark #main-content {
            color: #000000;
        }

        html.light #main-content {
            color: #374151;
        }

        .sidebar-minimized .sidebar-logo {
            display: none;
        }
    </style>
    <script>
        const theme = localStorage.getItem('theme') || 'light';
        document.documentElement.classList.add(theme);
        const sidebarState = localStorage.getItem('sidebarState') || 'expanded';
        if (sidebarState === 'minimized') {
            document.documentElement.classList.add('sidebar-minimized');
        }
    </script>
</head>
<body class="min-h-screen">
    <!-- Mobile Navigation -->
    <nav class="lg:hidden fixed top-0 left-0 right-0 z-50 floating-nav">
        <div class="flex items-center justify-between p-4">
            <button id="mobile-menu-toggle" class="p-2 rounded-xl hover:bg-white/10 transition-all duration-200 group">
                <div class="w-6 h-6 flex flex-col justify-center items-center">
                    <span class="w-5 h-0.5 bg-white rounded-full transition-all duration-300 group-hover:w-6" id="line1"></span>
                    <span class="w-5 h-0.5 bg-white rounded-full mt-1 transition-all duration-300 group-hover:w-6" id="line2"></span>
                    <span class="w-5 h-0.5 bg-white rounded-full mt-1 transition-all duration-300 group-hover:w-6" id="line3"></span>
                </div>
            </button>
            <div class="flex items-center space-x-3">
                <img src="/image/logo_pelita.webp" alt="Logo Pelita" class="w-10 h-10">
            </div>
        </div>
        <div id="mobile-menu" class="absolute top-full left-0 right-0 bg-slate-900/95 backdrop-blur-xl border-t border-white/10 transform -translate-y-full opacity-0 transition-all duration-300 pointer-events-none">
            <div class="p-4 space-y-2">
                <a href="{{ route('murid.dashboard') }}" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-white/10 transition-all duration-200 text-white nav-item {{ request()->is('murid/dashboard*') || request()->is('profile*') ? 'active-nav' : '' }}">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span class="sidebar-text">Halaman Utama</span>
                </a>
                <div class="my-4">
                    <h5 class="text-amber-400 font-semibold text-sm uppercase tracking-wide px-3 mb-2">Murid Tools</h5>
                    <div class="space-y-1">
                        <a href="{{ route('murid.jadwal') }}" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-white/10 transition-all duration-200 text-white nav-item {{ request()->is('murid/jadwal*') ? 'active-nav' : '' }}">
                            <i class="fas fa-calendar-days w-5 text-center"></i>
                            <span class="sidebar-text">Jadwal Kelas</span>
                        </a>
                        <a href="{{ route('murid.nilai') }}" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-white/10 transition-all duration-200 text-white nav-item {{ request()->is('murid/nilai*') ? 'active-nav' : '' }}">
                            <i class="fas fa-scroll w-5 text-center"></i>
                            <span class="sidebar-text">Nilai Murid</span>
                        </a>
                        <a href="{{ route('murid.pengumuman') }}" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-white/10 transition-all duration-200 text-white nav-item {{ request()->is('murid/pengumuman*') ? 'active-nav' : '' }}">
                            <i class="fas fa-bullhorn w-5 text-center"></i>
                            <span class="sidebar-text">Pengumuman</span>
                        </a>
                    </div>
                </div>
                <div class="border-t border-white/10 pt-4">
                    <button id="theme-toggle-mobile" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-700/20 transition-all duration-200 text-gray-400 w-full text-left nav-item group">
                        <i class="fas fa-moon w-5 text-center group-hover:scale-110 transition-transform duration-200"></i>
                        <span class="sidebar-text font-medium">Toggle Dark/Light Mode</span>
                    </button>
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-red-500/20 transition-all duration-200 text-red-400 w-full text-left nav-item group">
                            <i class="fas fa-sign-out-alt w-5 text-center group-hover:scale-110 transition-transform duration-200"></i>
                            <span class="sidebar-text font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Desktop Sidebar -->
    <aside id="sidebar" class="hidden lg:flex fixed top-0 left-0 h-full sidebar-transition z-40 flex-col bg-gradient-to-b from-slate-800 to-slate-900 shadow-2xl border-r border-white/10">
        <div class="p-6 border-b border-white/10">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                    <div class="relative sidebar-logo">
                        <img src="/image/logo_pelita.webp" alt="Logo Pelita" class="w-12 h-12">
                    </div>
                    <div class="sidebar-text">
                        <h3 class="text-white font-bold text-xl gradient-text">{{ auth()->user()->name }}</h3>
                        <p class="text-slate-400 text-sm" id="greeting">Selamat Pagi</p>
                    </div>
                </div>
                <button id="sidebar-toggle" class="p-2 rounded-xl hover:bg-white/10 transition-all duration-200 group">
                    <i class="fas fa-bars text-white group-hover:text-amber-400 transition-colors duration-200"></i>
                </button>
            </div>
        </div>
        <nav class="flex-1 p-4 custom-scrollbar overflow-y-auto">
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('murid.dashboard') }}" class="flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 nav-item group {{ request()->is('murid/dashboard*') || request()->is('profile*') ? 'active-nav' : 'hover:bg-white/10 text-white' }}">
                        <i class="fas fa-home w-5 text-center group-hover:scale-110 transition-transform duration-200"></i>
                        <span class="sidebar-text font-medium">Halaman Utama</span>
                    </a>
                </li>
                <li class="pt-4">
                    <h5 class="text-amber-400 font-semibold text-sm uppercase tracking-wide px-3 mb-3 sidebar-text">Murid Tools</h5>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('murid.jadwal') }}" class="flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 nav-item group {{ request()->is('murid/jadwal*') ? 'active-nav' : 'hover:bg-white/10 text-white' }}">
                                <i class="fas fa-calendar-days w-5 text-center group-hover:scale-110 transition-transform duration-200"></i>
                                <span class="sidebar-text font-medium">Jadwal Kelas</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('murid.nilai') }}" class="flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 nav-item group {{ request()->is('murid/nilai*') ? 'active-nav' : 'hover:bg-white/10 text-white' }}">
                                <i class="fas fa-scroll w-5 text-center group-hover:scale-110 transition-transform duration-200"></i>
                                <span class="sidebar-text font-medium">Nilai Murid</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('murid.pengumuman') }}" class="flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 nav-item group {{ request()->is('murid/pengumuman*') ? 'active-nav' : 'hover:bg-white/10 text-white' }}">
                                <i class="fas fa-bullhorn w-5 text-center group-hover:scale-110 transition-transform duration-200"></i>
                                <span class="sidebar-text font-medium">Pengumuman</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="p-4 border-t border-white/10">
            <button id="theme-toggle-desktop" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-700/20 transition-all duration-200 text-gray-400 w-full text-left nav-item group">
                <i class="fas fa-moon w-5 text-center group-hover:scale-110 transition-transform duration-200"></i>
                <span class="sidebar-text font-medium">Toggle Dark/Light Mode</span>
            </button>
            <form action="{{ route('logout') }}" method="POST" class="block">
                @csrf
                <button type="submit" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-red-500/20 transition-all duration-200 text-red-400 w-full text-left nav-item group">
                    <i class="fas fa-sign-out-alt w-5 text-center group-hover:scale-110 transition-transform duration-200"></i>
                    <span class="sidebar-text font-medium">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <script>
        function updateGreeting() {
            const now = new Date();
            const hour = now.getHours();
            let greeting = '';
            
            if (hour >= 5 && hour < 12) {
                greeting = 'Selamat Pagi';
            } else if (hour >= 12 && hour < 17) {
                greeting = 'Selamat Siang';
            } else if (hour >= 17 && hour < 21) {
                greeting = 'Selamat Sore';
            } else {
                greeting = 'Selamat Malam';
            }
            
            const greetingElement = document.getElementById('greeting');
            if (greetingElement) {
                greetingElement.textContent = greeting;
            }
        }

        function initializeMobileMenu() {
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            const line1 = document.getElementById('line1');
            const line2 = document.getElementById('line2');
            const line3 = document.getElementById('line3');
            
            let isMenuOpen = false;
            
            mobileMenuToggle.addEventListener('click', () => {
                isMenuOpen = !isMenuOpen;
                
                if (isMenuOpen) {
                    mobileMenu.classList.remove('-translate-y-full', 'opacity-0', 'pointer-events-none');
                    mobileMenu.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
                    line1.style.transform = 'rotate(-90deg) translate(-6px, -6px)';
                    line2.style.transform = 'rotate(-90deg) translate(0px, 0px)';
                    line3.style.transform = 'rotate(-90deg) translate(6px, 6px)';
                } else {
                    mobileMenu.classList.add('-translate-y-full', 'opacity-0', 'pointer-events-none');
                    mobileMenu.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
                    line1.style.transform = 'rotate(0) translate(0, 0)';
                    line2.style.transform = 'rotate(0) translate(0, 0)';
                    line3.style.transform = 'rotate(0) translate(0, 0)';
                }
            });
        }

        function initializeSidebar() {
            const sidebarToggle = document.getElementById('sidebar-toggle');
            
            function toggleSidebar(minimize) {
                if (minimize) {
                    document.documentElement.classList.add('sidebar-minimized');
                    localStorage.setItem('sidebarState', 'minimized');
                } else {
                    document.documentElement.classList.remove('sidebar-minimized');
                    localStorage.setItem('sidebarState', 'expanded');
                }
            }
            
            sidebarToggle.addEventListener('click', () => {
                const currentlyMinimized = document.documentElement.classList.contains('sidebar-minimized');
                toggleSidebar(!currentlyMinimized);
            });
        }

        function initializeThemeToggle() {
            const themeToggleDesktop = document.getElementById('theme-toggle-desktop');
            const themeToggleMobile = document.getElementById('theme-toggle-mobile');
            const themeIconDesktop = themeToggleDesktop.querySelector('i');
            const themeTextDesktop = themeToggleDesktop.querySelector('span');
            const themeIconMobile = themeToggleMobile.querySelector('i');
            const themeTextMobile = document.querySelector('#theme-toggle-mobile span');

            function updateThemeIconAndText(isDark) {
                if (isDark) {
                    themeIconDesktop.classList.replace('fa-sun', 'fa-moon');
                    themeIconMobile.classList.replace('fa-sun', 'fa-moon');
                    themeTextDesktop.textContent = 'Dark Mode';
                    themeTextMobile.textContent = 'Dark Mode';
                } else {
                    themeIconDesktop.classList.replace('fa-moon', 'fa-sun');
                    themeIconMobile.classList.replace('fa-moon', 'fa-sun');
                    themeTextDesktop.textContent = 'Light Mode';
                    themeTextMobile.textContent = 'Light Mode';
                }
            }

            const currentTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.classList.add(currentTheme);
            updateThemeIconAndText(currentTheme === 'dark');

            [themeToggleDesktop, themeToggleMobile].forEach(toggle => {
                toggle.addEventListener('click', () => {
                    const isDark = document.documentElement.classList.contains('dark');
                    document.documentElement.classList.toggle('dark', !isDark);
                    document.documentElement.classList.toggle('light', isDark);
                    localStorage.setItem('theme', isDark ? 'light' : 'dark');
                    updateThemeIconAndText(!isDark);
                });
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateGreeting();
            initializeMobileMenu();
            initializeSidebar();
            initializeThemeToggle();
            setInterval(updateGreeting, 60000);
        });
    </script>
</body>
</html>