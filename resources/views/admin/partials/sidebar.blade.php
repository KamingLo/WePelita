<link rel="stylesheet" href="{{ asset('css/AdminCSS/SidebarAdmin.css') }}" />
<body>
  <aside class="ContainerSideBar">
    <div class="ProfileSiUser">
        <div class="HeaderUser">
            <a href="/admin/dashboard">
                <img src="/image/logo_pelita.png"/>
            </a>
            <h6 class="ohayo" id="Sapaan">Selamat Pagi</h6>
        </div>
        <h6 class="UseridName">{{ auth()->user()->profile->name ?? 'Admin' }}</h6>
    </div>

    <ul class="ListSideBar">

      <li>
        <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard*') ? 'active-link' : '' }}">
          <i class='bx bx-home-alt IconSidebar'></i>Halaman Utama
        </a>
      </li>

      <h4>
        <span>Admin Tools</span>
      </h4>

      <li>
        <a href="/admin/TambahPelajaran" class="{{ request()->is('admin/TambahPelajaran*') ? 'active-link' : '' }}">
          <i class='bx bx-list-plus IconSideBar'></i>Tambah Pelajaran
        </a>
      </li>
      <li>
        <a href="/admin/TambahJadwal" class="{{ request()->is('admin/TambahJadwal*') || request()->is('admin/jadwal/edit/*') ? 'active-link' : '' }}">
            <i class='bx bx-layer-plus IconSideBar'></i>Tambahkan Jadwal
        </a>
      </li>
        <li>
        <a href="/admin/manajemenKelas" class="{{ request()->is('admin/manajemenKelas*') ? 'active-link' : '' }}">
          <i class='bx bx-category-alt IconSideBar'></i>Manajemen Kelas
        </a>
      </li>
      <li>
        <a href="/admin/ManajemenUser" class="{{ request()->is(['admin/ManajemenUser*', 'admin/user*']) ? 'active-link' : '' }}">
          <i class='bx bx-user IconSideBar' ></i>Manajemen User
        </a>
      </li>
      <li>
        <a href="/admin/manajemenPost" class="{{ request()->is('admin/manajemenPost*') ? 'active-link' : '' }}">
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
</body>

<script src="{{ asset('js/dashboard.js') }}"></script>