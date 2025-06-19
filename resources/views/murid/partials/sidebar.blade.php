<link rel="stylesheet" href="{{ asset('css/MuridCSS/SidebarMurid.css') }}" />

<body>
    <aside class="ContainerSideBar">
        <div class="ProfileSiUser">
            <div class="HeaderUser">
                <a href="{{ route('murid.dashboard') }}">
                    <img src="/image/logo_pelita.png" alt="Logo Pelita"/>
                </a>
                <h3 class="ohayo" id="Sapaan">Selamat Pagi</h3>
            </div>
            <h3 class="UseridName">{{ auth()->user()->name }}</h3>
        </div>

        <ul class="ListSideBar">
            <span>‎</span> {{-- ‎ ni buat teks kosong --}}

            <li>
                <a href="{{ route('murid.dashboard') }}" class="{{ request()->is('murid/dashboard*') || request()->is('profile*') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-house IconSideBar"></i>Halaman Utama
                </a>
            </li>

            <h5>
                <span>Murid Tools</span>
            </h5>

            <li>
                <a href="{{ route('murid.jadwal') }}" class="{{ request()->is('murid/jadwal*') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-calendar-days IconSideBar"></i>Jadwal Kelas
                </a>
            </li>

            <li>
                <a href="{{ route('murid.nilai') }}" class="{{ request()->is('murid/nilai*') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-scroll IconSideBar"></i>Nilai Murid
                </a>
            </li>

            <li>
                <a href="{{ route('murid.pengumuman') }}" class="{{ request()->is('murid/pengumuman*') ? 'active-link' : '' }}">
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