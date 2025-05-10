<body>
  <aside class="sidebar">
    <div class="ProfileSiUser">
        
        <div class="HeaderUser">
            <a href="/admin/dashboard">
                <img src="/image/logo_pelita.png"/>
            </a>
            <h2 class="ohayo" id="Sapaan">Selamat Pagi</h2>
        </div>

        <h2 class="UseridName">Admin</h2>
    </div>

    <ul class="sidebar-links">
      <h4>
        <span>Main Menu</span>
        <div class="menu-separator"></div>
      </h4>
      <li>
        <a href="/admin/register"><i class='bx bx-user-plus IconSidebar'></i>Register User</a>
      </li>
      <li>
        <a href="/admin/jadwal"><i class='bx bx-layer-plus IconSideBar'></i>Jadwal Pembelajaran</a>
      </li>
      <li>
        <a href="/admin/pelajaran"><i class='bx bx-list-plus IconSideBar'></i>Tambah Pelajaran</a>
      </li>
        <li>
        <a href="/admin/posting"><i class='bx bx-send IconSideBar'></i>Tambah posting</a>
      </li>
      <h4>
        <span>General</span>
        <div class="menu-separator"></div>
      </h4>
  
      <h4>

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