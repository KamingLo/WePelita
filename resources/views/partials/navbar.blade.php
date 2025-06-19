<link rel="stylesheet" href="{{ asset('css/Partials/Navbar.css') }}" />

<header>
  <nav class="navbar">
    <div class="navbar-container">
      <div class="logo">
        <a href="/">
          <img class="GambarLogo" src="/image/LogoPelitaProject.png" alt="Logo Pelita Project">
        </a>
      </div>

      <!-- Mobile menu button -->
      <div class="mobile-menu-btn">
        <span></span>
        <span></span>
        <span></span>
      </div>

      <div class="navbtn">
        <a href="/blog">Blog</a>

        @auth
            @php
                $role = session('role');
                $dashboardRoute = match($role) {
                    'admin' => route('admin.dashboard'),
                    'guru' => route('guru.dashboard'),
                    'murid' => route('murid.dashboard'),
                    'orang_tua' => route('orangtua.dashboard'),
                    default => '/',
                };
            @endphp
            <a class="sign-btn" href="{{ $dashboardRoute }}"><span>Kembali Ke Dashboard</span></a>
        @else
          <a class="" href="{{ route('register') }}"><span>Register</span></a>
          <a class="" href="{{ route('login') }}"><span>Login</span></a>
        @endauth
      </div>
    </div>
  </nav>
</header>

<script>
// Simple mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navbtn = document.querySelector('.navbtn');
    
    if (mobileMenuBtn && navbtn) {
        mobileMenuBtn.addEventListener('click', function() {
            navbtn.classList.toggle('active');
            mobileMenuBtn.classList.toggle('active');
        });
    }
});
</script>