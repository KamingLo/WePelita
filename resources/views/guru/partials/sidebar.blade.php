<link rel="stylesheet" href="{{ asset('css/AdminCSS/SidebarAdmin.css') }}" />

<body>
    <aside class="ContainerSideBar">
        <div class="ProfileSiUser">
            <div class="HeaderUser">
                <a href="{{ route('guru.dashboard') }}" wire:navigate>
                    <img src="/image/logo_pelita.png" alt="Logo Pelita"/>
                </a>
                <h6 class="ohayo" id="Sapaan">Selamat Pagi</h6>
            </div>
            <h6 class="UseridName">{{ auth()->user()->name }}</h6>
        </div>

        <ul class="ListSideBar">
            <span>‎</span> {{-- ‎ ni buat teks kosong --}}

            <li>
                <a href="{{ route('guru.dashboard') }}" class="{{ request()->is('guru/dashboard*') ? 'active-link' : '' }}">
                    <i class='bx bx-home-alt IconSidebar'></i>Halaman Utama
                </a>
            </li>

            <h4>
                <span>Guru Tools</span>
            </h4>

            <li>
                <a href="{{ route('guru.jadwal') }}" class="{{ request()->is('guru/jadwal') ? 'active-link' : '' }}">
                    <i class='bx bx-table IconSidebar'></i>Lihat Jadwal Pelajaran
                </a>
            </li>
            
            <li>
                <a href="{{ route('guru.jadwalanda') }}" class="{{ request()->is('guru/jadwalanda*') ? 'active-link' : '' }}">
                    <i class='bx bx-table IconSidebar'></i>Lihat Jadwal Ajar Anda
                </a>
            </li>

            <li>
                <a href="{{ route('guru.isinilai') }}" class="{{ request()->is('guru/menu-nilai*') ? 'active-link' : '' }}">
                    <i class='bx bx-home-alt IconSidebar'></i>Menu Nilai
                </a>
            </li>

            <li>
                <a href="{{ route('guru.ManajemenPost') }}" class="{{ request()->is('guru/ManajemenPost*') ? 'active-link' : '' }}">
                    <i class='bx bx-message-square-edit IconSideBar'></i>Manajemen Postingan
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