<link rel="stylesheet" href="{{ asset('css/OrtuCSS/SidebarOrtu.css') }}" />

<body>
    <aside class="ContainerSideBar">
        <div class="ProfileSiUser">
            <div class="HeaderUser">
                    <img src="/image/logo_pelita.png" alt="Logo Pelita"/>
                </a>
                <h3 class="ohayo" id="Sapaan">Selamat Pagi</h3>
            </div>
            <h3 class="UseridName">{{ auth()->user()->name }}</h3>
        </div>

        <ul class="ListSideBar">
            <span>‎</span> {{-- ‎ ni buat teks kosong --}}

            <li>
                <a href="{{ route('orangtua.dashboard') }}" class="{{ request()->is('orangtua/dashboard*') || request()->is('profile*') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-house IconSideBar"></i>Halaman Utama
                </a>
            </li>

            <h5>
                <span>Parent Tools</span>
            </h5>

            <li>
                <a href="{{ route('orangtua.jadwal') }}" class="{{ request()->is('orangtua/jadwal*') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-calendar-days IconSideBar"></i>Jadwal Kelas
                </a>
            </li>

            <li>
                <a href="{{ route('orangtua.nilai') }}" class="{{ request()->is('orangtua/nilai*') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-scroll IconSideBar"></i>Nilai Anak
                </a>
            </li>

            <li>
                <a href="{{ route('orangtua.pengumuman') }}" class="{{ request()->is('orangtua/pengumuman*') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-bullhorn IconSideBar"></i>Pengumuman
                </a>
            </li>
        </ul>

        <div class="BagianBawahSideBar">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="TombolLogout">
                    <i class="fa-solid fa-arrow-right-from-bracket IconSideBar"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>