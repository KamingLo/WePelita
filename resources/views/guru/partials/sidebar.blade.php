<link rel="stylesheet" href="{{ asset('css/AdminCSS/SidebarAdmin.css') }}" />

<body>
  <aside class="ContainerSideBar">
    <div class="ProfileSiUser">
        <div class="HeaderUser">
            <a href="dashboard">
                <img src="/image/logo_pelita.png"/>
            </a>
            <h6 class="ohayo" id="Sapaan">Selamat Pagi</h6>
        </div>

        <h6 class="UseridName">{{ $guru->profile->name }}</h6>
    </div>

    <ul class="ListSideBar">
        <span>‎</span> {{-- ‎ ni buat teks kosong --}}

      <li>
        <a href="dashboard" class="{{ request()->routeIs('guru.dashboard*') ? 'active-link' : '' }}">
          <i class='bx bx-home-alt IconSidebar'></i>Halaman Utama
        </a>
      </li>

      <h4>
        <span>Guru Tools</span>
      </h4>

      <li>
        <a href="jadwal" class="{{ request()->routeIs('guru.jadwal') ? 'active-link' : '' }}">
          <i class='bx bx-table IconSidebar'></i>Liat Jadwal Pelajaran
        </a>
      </li>
      
      <li>
        <a href="jadwalanda" class="{{ request()->routeIs('guru.jadwalanda') ? 'active-link' : '' }}">
          <i class='bx bx-table IconSidebar'></i>Liat Jadwal Ajar Anda
        </a>
      </li>
      <li>
        <a href="menu-nilai" class="{{ request()->routeIs('guru.isinilai*') ? 'active-link' : '' }}">
          <i class="bx bx-home-alt IconSidebar"></i>Menu nilai
        </a>
      </li>
      <li>
        <a href="/guru/ManajemenPost" class="{{ request()->routeIs('guru.ManajemenPost*') ? 'active-link' : '' }}">
          <i class='bx bx-message-square-edit IconSideBar'></i>Manajemen postingan
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