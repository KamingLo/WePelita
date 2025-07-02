<body class="relative">
    <nav class="fixed top-0 left-0 w-full bg-gray-900 text-white py-2 px-4 z-50 lg:hidden">
        <div class="flex justify-between items-center">
            <button id="mobile-menu-button" class="focus:outline-none">
                <svg class="w-6 h-6 fill-current text-white transition-transform duration-300" viewBox="0 0 24 24" id="hamburger-icon">
                    <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2z"/>
                </svg>
            </button>
            <img src="/image/logo_pelita.png" alt="Logo Pelita" class="w-8 h-8 rounded-full">
        </div>

        <div id="mobile-menu" class="absolute top-full left-0 w-full bg-gray-900 shadow-md rounded-b-md overflow-hidden transition-all duration-300 ease-in-out transform origin-top scale-y-0 opacity-0 z-40">
            <ul class="py-2">
                <li class="mb-1">
                    <a href="{{ route('murid.dashboard') }}"
                       class="block px-4 py-2 text-white hover:bg-gray-800 transition-colors duration-200 {{ request()->is('murid/dashboard*') || request()->is('profile*') ? 'bg-yellow-300 text-gray-900' : '' }}">
                        <i class="fa-solid fa-house mr-3"></i>Halaman Utama
                    </a>
                </li>
                <li class="border-b border-gray-800 my-1"></li>
                <h5 class="px-4 py-2 text-gray-400 font-medium">Murid Tools</h5>
                <li class="mb-1">
                    <a href="{{ route('murid.jadwal') }}"
                       class="block px-4 py-2 text-white hover:bg-gray-800 transition-colors duration-200 {{ request()->is('murid/jadwal*') ? 'bg-yellow-300 text-gray-900' : '' }}">
                        <i class="fa-solid fa-calendar-days mr-3"></i>Jadwal Kelas
                    </a>
                </li>
                <li class="mb-1">
                    <a href="{{ route('murid.nilai') }}"
                       class="block px-4 py-2 text-white hover:bg-gray-800 transition-colors duration-200 {{ request()->is('murid/nilai*') ? 'bg-yellow-300 text-gray-900' : '' }}">
                        <i class="fa-solid fa-scroll mr-3"></i>Nilai Murid
                    </a>
                </li>
                <li class="mb-1">
                    <a href="{{ route('murid.pengumuman') }}"
                       class="block px-4 py-2 text-white hover:bg-gray-800 transition-colors duration-200 {{ request()->is('murid/pengumuman*') ? 'bg-yellow-300 text-gray-900' : '' }}">
                        <i class="fa-solid fa-bullhorn mr-3"></i>Pengumuman
                    </a>
                </li>
                <li class="border-b border-gray-800 my-1"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="block px-4 py-2 text-white hover:bg-gray-800 w-full text-left transition-colors duration-200">
                            <i class="fa-solid fa-arrow-right-from-bracket mr-3"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <aside class="fixed top-0 left-0 h-full w-64 flex flex-col bg-gray-900 text-white p-6 transition-all duration-400 ease-in-out overflow-x-hidden group lg:flex hidden" style="z-index: 49;">
        <div class="flex flex-col items-start mb-6">
            <div class="flex items-center mb-2">
                <img src="/image/logo_pelita.png" alt="Logo Pelita" class="w-10 h-10 rounded-full transform translate-y-1">
                <div>
                    <h3 class="text-xl font-semibold whitespace-nowrap ml-4 text-white" id="Sapaan">Selamat Pagi</h3>
                    <h3 class="text-xl font-semibold whitespace-nowrap ml-4 text-white">{{ auth()->user()->name }}</h3>
                </div>
            </div>
        </div>

        <ul class="flex-1 mt-2 overflow-y-auto custom-scrollbar">
            <span class="block my-2"></span>
            <li class="mb-1">
                <a href="{{ route('murid.dashboard') }}"
                   class="flex items-center gap-5 p-4 rounded-lg transition-all duration-200 ease-in-out
                          hover:bg-white hover:text-black hover:shadow-lg
                          {{ request()->is('murid/dashboard*') || request()->is('profile*') ? 'bg-yellow-300 text-gray-900 shadow-md' : 'text-white font-normal' }}">
                    <i class="fa-solid fa-house text-2xl w-8 text-center"></i>Halaman Utama
                </a>
            </li>

            <h5 class="text-white font-medium whitespace-nowrap my-4 relative border-b-2 border-white pb-1 leading-loose">
                <span>Murid Tools</span>
            </h5>

            <li class="mb-1">
                <a href="{{ route('murid.jadwal') }}"
                   class="flex items-center gap-5 p-4 rounded-lg transition-all duration-200 ease-in-out
                          hover:bg-white hover:text-black hover:shadow-lg
                          {{ request()->is('murid/jadwal*') ? 'bg-yellow-300 text-gray-900 shadow-md' : 'text-white font-normal' }}">
                    <i class="fa-solid fa-calendar-days text-2xl w-8 text-center"></i>Jadwal Kelas
                </a>
            </li>

            <li class="mb-1">
                <a href="{{ route('murid.nilai') }}"
                   class="flex items-center gap-5 p-4 rounded-lg transition-all duration-200 ease-in-out
                          hover:bg-white hover:text-black hover:shadow-lg
                          {{ request()->is('murid/nilai*') ? 'bg-yellow-300 text-gray-900 shadow-md' : 'text-white font-normal' }}">
                    <i class="fa-solid fa-scroll text-2xl w-8 text-center"></i>Nilai Murid
                </a>
            </li>

            <li class="mb-1">
                <a href="{{ route('murid.pengumuman') }}"
                   class="flex items-center gap-5 p-4 rounded-lg transition-all duration-200 ease-in-out
                          hover:bg-white hover:text-black hover:shadow-lg
                          {{ request()->is('murid/pengumuman*') ? 'bg-yellow-300 text-gray-900 shadow-md' : 'text-white font-normal' }}">
                    <i class="fa-solid fa-bullhorn text-2xl w-8 text-center"></i>Pengumuman
                </a>
            </li>
        </ul>

        <div class="mt-auto mb-2">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-5 text-white font-medium whitespace-nowrap
                                       p-4 rounded-md transition-all duration-200 ease-in-out
                                       bg-transparent border-none cursor-pointer w-full text-left
                                       hover:text-gray-900 hover:bg-white hover:rounded-md mt-4">
                    <i class="fa-solid fa-arrow-right-from-bracket text-3xl w-8 text-center"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const sidebar = document.querySelector('aside');

        if (mobileMenuButton && mobileMenu && sidebar) {
            mobileMenuButton.addEventListener('click', () => {
                const isMenuOpen = mobileMenu.classList.contains('scale-y-100');

                if (isMenuOpen) {
                    mobileMenu.classList.remove('scale-y-100', 'opacity-100');
                    mobileMenu.classList.add('scale-y-0', 'opacity-0');
                } else {
                    mobileMenu.classList.remove('scale-y-0', 'opacity-0');
                    mobileMenu.classList.add('scale-y-100', 'opacity-100');
                }
            });

            mobileMenu.classList.add('scale-y-0', 'opacity-0');

            const bodyElement = document.querySelector('body');
            if (bodyElement) {
                bodyElement.style.paddingTop = `${document.querySelector('nav.lg\\:hidden').offsetHeight}px`;
            }
        }
    </script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>