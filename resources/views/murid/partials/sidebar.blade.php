<link rel="stylesheet" href="{{ asset('css/MuridCSS/SidebarMurid.css') }}" />

<body>
    <aside class="ContainerSideBar">
        <div class="ProfileSiUser">
            <div class="HeaderUser">
                <a href="{{ route('murid.dashboard') }}">
                    <img src="/image/logo_pelita.png" alt="Logo Pelita"/>
                </a>
                <h6 class="ohayo" id="Sapaan">Selamat Pagi</h6>
            </div>
            <h6 class="UseridName">{{ auth()->user()->name }}</h6>
        </div>

        <ul class="ListSideBar">
            <span>‎</span> {{-- ‎ ni buat teks kosong --}}

            <li>
                <a href="{{ route('murid.dashboard') }}" class="{{ request()->is('murid/dashboard*') || request()->is('profile*') ? 'active-link' : '' }}">
                    <i class='bx bx-home-alt IconSidebar'></i>Halaman Utama
                </a>
            </li>

            <h6>
                <span style="font-size: 15px;">Murid Tools</span>
            </h6>

            <li>
                <a href="{{ route('murid.jadwal') }}" class="{{ request()->is('murid/jadwal*') ? 'active-link' : '' }}">
                    <i class='bx bx-table IconSidebar'></i>Jadwal Kelas
                </a>
            </li>

            <li>
                <a href="{{ route('murid.nilai') }}" class="{{ request()->is('murid/nilai*') ? 'active-link' : '' }}">
                    <i class='bx bx-table IconSidebar'></i>Nilai Murid
                </a>
            </li>

            <li>
                <a href="{{ route('murid.pengumuman') }}" class="{{ request()->is('murid/pengumuman*') ? 'active-link' : '' }}">
                    <i class='bx bx-bell IconSidebar'></i>Pengumuman
                </a>
            </li>
        </ul>

        <div class="logout-container">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">
                    <i class='bx bx-log-out IconSideBar'></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>