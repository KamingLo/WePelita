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
        <h6 class="UseridName">{{ $murid->profile->name }}</h6>
    </div>

    <ul class="ListSideBar">

        <span>‎</span> {{-- ‎ ni buat teks kosong --}}

      <li>
        <a href="dashboard" class="{{ request()->is('murid/dashboard*') ? 'active-link' : '' }}">
          <i class='bx bx-home-alt IconSidebar'></i>Halaman Utama
        </a>
      </li>

      <h4>
        <span>Guru Tools</span>
      </h4>

      <li>
          <a href="{{ route('murid.jadwal') }}" class="{{ request()->is(' murid/jadwal*') ? 'active-link' : '' }}">
              <i class='bx bx-table IconSidebar'></i>Jadwal Kelas
          </a>
      </li>

      <li>
          <a href="{{ route('murid.nilai') }}" class="{{ request()->is(' murid/nilai*') ? 'active-link' : '' }}">
              <i class='bx bx-table IconSidebar'></i>Nilai Murid
          </a>
      </li>
    
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