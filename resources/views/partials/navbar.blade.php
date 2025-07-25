<header>
    <nav class="bg-white shadow-md fixed top-0 left-0 right-0 z-50 h-20">
        <div class="w-full px-4 sm:px-6 lg:px-8 h-full flex items-center justify-between">

            <div class="flex">
                <a href="/" class="block">
                    <img class="h-8 sm:h-10 md:h-10 lg:h-10 w-auto" src="/image/LogoPelitaProject.png" alt="Logo Pelita Project">
                </a>
            </div>

            <div class="md:hidden flex items-center">
                <button class="mobile-menu-btn focus:outline-none relative w-8 h-6">
                    <span class="block w-full h-0.5 bg-gray-700 absolute top-0 left-0 transition-all duration-300 ease-in-out"></span>
                    <span class="block w-full h-0.5 bg-gray-700 absolute top-1/2 left-0 transform -translate-y-1/2 transition-all duration-300 ease-in-out"></span>
                    <span class="block w-full h-0.5 bg-gray-700 absolute bottom-0 left-0 transition-all duration-300 ease-in-out"></span>
                </button>
            </div>

            <div class="navbtn hidden md:flex items-center space-x-6">
                <a href="/DaftarGuru" class="text-gray-700 hover:mr-2 hover:ml-2 hover:text-blue-600 px-3 py-2 rounded-md text-base font-medium transition-all duration-300 ease-in-out">Daftar Guru</a>
                <a href="/profile-sekolah" class="text-gray-700 hover:mr-2 hover:ml-2 hover:text-blue-600 px-3 py-2 rounded-md text-base font-medium transition-all duration-300 ease-in-out">Profil kami</a>
                <a href="/program" class="text-gray-700 hover:mr-2 hover:ml-2 hover:text-blue-600 px-3 py-2 rounded-md text-base font-medium transition-all duration-300 ease-in-out">Program Keahlian</a>
                <a href="/blog" class="text-gray-700 hover:mr-2 hover:ml-2 hover:text-blue-600 px-3 py-2 rounded-md text-base font-medium transition-all duration-300 ease-in-out">Blog</a>

                @auth
                    @php
                        $role = session('role');
                        $dashboardRoute = match($role) {
                            'admin' => route('admin.dashboard'),
                            'guru' => route('guru.dashboard'),
                            'murid' => route('murid.dashboard'),
                            'orangtua' => route('orangtua.dashboard'),
                            default => '/',
                        };
                    @endphp
                    <a class="hover:translate-x-1 transition-all duration-300 ease-in-out px-5 py-2 border border-blue-600 text-blue-600 rounded-md text-base font-semibold hover:bg-blue-600 hover:text-white" href="{{ $dashboardRoute }}">
                        <span>Dashboard</span>
                    </a>
                @else
                    <a class="px-5 py-2 text-gray-700 border border-gray-300 rounded-md text-base font-semibold hover:bg-gray-100 transition-all duration-200 ease-in-out" href="{{ route('register') }}"><span>Register</span></a>
                    <a class="px-5 py-2 bg-blue-600 text-white rounded-md text-base font-semibold hover:bg-blue-700 transition-all duration-200 ease-in-out" href="{{ route('login') }}"><span>Login</span></a>
                @endauth
            </div>
        </div>

        <div class="navbtn-mobile md:hidden absolute top-full left-0 right-0 bg-white shadow-lg py-4 transition-all duration-300 ease-in-out transform -translate-y-full opacity-0 invisible">
            <div class="flex flex-col items-center space-y-4 px-4">
                <a href="/DaftarGuru" class="block w-full text-center text-gray-700 hover:text-blue-600 py-2 rounded-md text-base font-medium transition-colors duration-200 ease-in-out">Daftar Guru</a>
                <a href="/blog" class="block w-full text-center text-gray-700 hover:text-blue-600 py-2 rounded-md text-base font-medium transition-colors duration-200 ease-in-out">Blog</a>

                @auth
                    @php
                        $role = session('role');
                        $dashboardRoute = match($role) {
                            'admin' => route('admin.dashboard'),
                            'guru' => route('guru.dashboard'),
                            'murid' => route('murid.dashboard'),
                            'orangtua' => route('orangtua.dashboard'),
                            default => '/',
                        };
                    @endphp
                    <a class="block w-full text-center px-5 py-2 border border-blue-600 text-blue-600 rounded-md text-base font-semibold hover:bg-blue-600 hover:text-white transition-all duration-200 ease-in-out" href="{{ $dashboardRoute }}"><span>Dashboard</span></a>
                @else
                    <a class="block w-full text-center px-5 py-2 text-gray-700 border border-gray-300 rounded-md text-base font-semibold hover:bg-gray-100 transition-all duration-200 ease-in-out" href="{{ route('register') }}"><span>Register</span></a>
                    <a class="block w-full text-center px-5 py-2 bg-blue-600 text-white rounded-md text-base font-semibold hover:bg-blue-700 transition-all duration-200 ease-in-out" href="{{ route('login') }}"><span>Login</span></a>
                @endauth
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navbtnMobile = document.querySelector('.navbtn-mobile');

        if (mobileMenuBtn && navbtnMobile) {
            mobileMenuBtn.addEventListener('click', function() {
                this.classList.toggle('active');

                if (navbtnMobile.classList.contains('opacity-0')) {
                    navbtnMobile.classList.remove('-translate-y-full', 'opacity-0', 'invisible');
                    navbtnMobile.classList.add('translate-y-0', 'opacity-100', 'visible');
                } else {
                    navbtnMobile.classList.remove('translate-y-0', 'opacity-100', 'visible');
                    navbtnMobile.classList.add('-translate-y-full', 'opacity-0', 'invisible');
                }
            });
        }
    });

    document.body.style.paddingTop = '80px';
</script>