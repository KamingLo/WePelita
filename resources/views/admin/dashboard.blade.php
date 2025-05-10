{{-- resources/views/admin/dashboard.blade.php --}}
@include('partials.header', ['NamaPage' => 'Halaman Utama'])

@if (session('role') == 'admin')
  {{-- Include sidebar dari partial --}}
  @include('partials.sidebar')

  <div class="home">
    <div class="text">Dashboard Admin</div>
    {{-- Konten dashboard di sini --}}
  </div>

@elseif (session('role') == 'guru')
  <p>Kamu belum login</p>
  <a href="/login">Login kembali disini</a>
@endif