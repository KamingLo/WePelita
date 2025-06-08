<link rel="stylesheet" href="{{ asset('css/AdminCSS/SidebarAdmin.css') }}" />

<body>
  <aside class="ContainerSideBar">
    <div class="ProfileSiUser">
      <div class="HeaderUser">
          <img src="/image/logo_pelita.png"/>
        </a>
        <h6 class="ohayo" id="Sapaan">Selamat Pagi</h6>
      </div>
      <h6 class="UseridName">{{ auth()->user()->name }}</h6>
    </div>

    <ul class="ListSideBar">
      <li>
        <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard*') || request()->is('profile*') ? 'active-link' : '' }}">
          <i class="fa-solid fa-house IconSideBar"></i>Halaman Utama
        </a>
      </li>

      <h4><span>Admin Tools</span></h4>

      <li>
        <a href="/admin/TambahPelajaran" class="{{ request()->is('admin/TambahPelajaran*') || request()->is('admin/pelajaran*') ? 'active-link' : '' }}">
          <i class="fa-solid fa-book IconSideBar"></i>Tambah Pelajaran
        </a>
      </li>
      <li>
        <a href="/admin/TambahJadwal" class="{{ request()->is('admin/TambahJadwal*') || request()->is('admin/jadwal/edit/*') ? 'active-link' : '' }}">
          <i class="fa-solid fa-calendar-days IconSideBar"></i>Tambahkan Jadwal
        </a>
      </li>
      <li>
        <a href="/admin/manajemenKelas" class="{{ request()->is('admin/manajemenKelas*') ? 'active-link' : '' }}">
          <i class="fa-solid fa-pen IconSideBar"></i>Manajemen Kelas
        </a>
      </li>
      <li>
        <a href="/admin/ManajemenUser" class="{{ request()->is(['admin/ManajemenUser*', 'admin/user*']) ? 'active-link' : '' }}">
          <i class="fa-solid fa-users IconSideBar"></i>Manajemen User
        </a>
      </li>
      <li>
        <a href="/admin/manajemenPost" class="{{ request()->is('admin/manajemenPost*') ? 'active-link' : '' }}">
          <i class="fa-solid fa-bullhorn IconSideBar"></i>Manajemen Postingan
        </a>
      </li>
      <li>
        <a href="/admin/NilaiSiswa" class="{{ request()->is('admin/NilaiSiswa*') ? 'active-link' : '' }}">
          <i class="fa-solid fa-scroll IconSideBar"></i>Nilai Siswa
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
</body>

<script src="{{ asset('js/dashboard.js') }}"></script>