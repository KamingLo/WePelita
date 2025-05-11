<body>
  <aside class="ContainerSideBar">
    <div class="ProfileSiUser">
        <div class="HeaderUser">
            <a href="/admin/dashboard">
                <img src="/image/logo_pelita.png"/>
            </a>
            <h2 class="ohayo" id="Sapaan">Selamat Pagi</h2>
        </div>

        <h2 class="UseridName">Admin</h2>
    </div>

    <ul class="ListSideBar">
      <h4>
        <span>Main Menu</span>
      </h4>
      <li>
        <a href="/admin/register" class="{{ request()->is('admin/register') ? 'active-link' : '' }}">
          <i class='bx bx-user-plus IconSidebar'></i>Daftar User Baru
        </a>
      </li>
      
      <li>
        <a href="/admin/manajemenUser" class="{{ request()->is('admin/post') ? 'active-link' : '' }}">
          <i class='bx bx-send IconSideBar'></i>Manajemen User
        </a>
      </li>

      <li>
        <a href="/admin/jadwal"
          class="{{ request()->is('admin/jadwal*') ? 'active-link' : '' }}">
          <i class='bx bx-layer-plus IconSideBar'></i>Tambahkan Jadwal
        </a>
      </li>
      <li>
        <a href="/admin/pelajaran" class="{{ request()->is('admin/pelajaran') ? 'active-link' : '' }}">
          <i class='bx bx-list-plus IconSideBar'></i>Tambah Pelajaran
        </a>
      </li>
      <li>
        <a href="/admin/post" class="{{ request()->is('admin/post') ? 'active-link' : '' }}">
          <i class='bx bx-send IconSideBar'></i>Tambah posting
        </a>
      </li>

            <li>
        <a href="/admin/manajemenPost" class="{{ request()->is('admin/post') ? 'active-link' : '' }}">
          <i class='bx bx-send IconSideBar'></i>Manajemen postingan
        </a>
      </li>

      <h4>
        <span>General</span>
        <div class="menu-separator"></div>
      </h4>

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