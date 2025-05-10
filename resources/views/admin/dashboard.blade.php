@include('partials.header', ['NamaPage' => 'Halaman Utama'])

@if (session('role') == 'admin')
    @include('partials.sidebar')

    <div class="home">
        <div class="text">Dashboard Admin</div>
    </div>
@elseif (session('role') == 'guru')
    <p>Kamu belum login</p>
    <a href="/login">Login kembali disini</a>
@endif