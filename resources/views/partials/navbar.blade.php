<header>
  <nav class="navbar">
    <div class="logo">
      <a href="/">
        <img class="GambarLogo" src="/image/LogoPelitaProject.png" alt="Logo Pelita Project">
      </a>
    </div>

    <div class="navbtn">
      <a href="/blog">Blog</a>
      <a href="#">About</a>

      @auth
          @php
              $role = session('role');
              $dashboardRoute = match($role) {
                  'admin' => route('admin.dashboard'),
                  'guru' => route('guru.dashboard'),
                  'murid' => route('murid.dashboard'),
                  'orang_tua' => route('orang_tua.dashboard'),
                  default => '/',
              };
          @endphp
          <a class="sign-btn" href="{{ $dashboardRoute }}"><span>Dashboard</span></a>
      @else
          <a class="sign-btn" href="{{ route('register') }}"><span>Register disini</span></a>

          <a class="sign-btn" href="{{ route('login') }}"><span>Login disini</span></a>
      @endauth
    </div>
  </nav>
</header>
