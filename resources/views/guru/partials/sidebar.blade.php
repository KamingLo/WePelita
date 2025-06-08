<link rel="stylesheet" href="{{ asset('css/GuruCSS/SidebarGuru.css') }}" />

<body>
    <aside class="ContainerSideBar">
        <div class="ProfileSiUser">
            <div class="HeaderUser">
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
                    <i class="fa-solid fa-house IconSideBar"></i>Halaman Utama
                </a>
            </li>

            <h4>
                <span>Guru Tools</span>
            </h4>

            <li>
                <a href="{{ route('guru.jadwal') }}" class="{{ request()->is('guru/jadwal') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-calendar-days IconSideBar"></i>Lihat Jadwal Pelajaran
                </a>
            </li>
            
            <li>
                <a href="{{ route('guru.jadwalanda') }}" class="{{ request()->is('guru/jadwalanda*') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-calendar-check IconSideBar"></i>Lihat Jadwal Ajar Anda
                </a>
            </li>

            <li>
                <a href="{{ route('guru.isinilai') }}" class="{{ request()->is('guru/menu-nilai*') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-scroll IconSideBar"></i>Menu Nilai
                </a>
            </li>

            <li>
                <a href="{{ route('guru.ManajemenPost') }}" class="{{ request()->is('guru/manajemenPost*') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-bullhorn IconSideBar"></i>Manajemen Postingan
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