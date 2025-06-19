@include('admin.partials.header')
@include('admin.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/Dashboard.css') }}" />

<div class="ContainerDashboard">
    <h1>Hi, {{ $admin->profile->name }}</h1>

    <div class="ShotcutSidebar">
        <a href="{{ route('admin.ManajemenUser') }}" class="TombolNya" data-aos="fade-up" data-aos-delay="100">
            <div class="IconFA"><i class="fas fa-users"></i></div>
            <h3>Manajemen User</h3>
            <p>Mengatur Akun Murid, Guru, Orangtua, dan Admin</p>
        </a>
        <a href="{{ route('admin.manajemenKelas') }}" class="TombolNya" data-aos="fade-up" data-aos-delay="200">
            <div class="IconFA"><i class="fas fa-chalkboard"></i></div>
            <h3>Manajemen Kelas</h3>
            <p>Membuat kelas dan kenaikan</p>
        </a>
        <a href="{{ route('admin.TambahJadwal') }}" class="TombolNya" data-aos="fade-up" data-aos-delay="300">
            <div class="IconFA"><i class="fas fa-calendar-alt"></i></div>
            <h3>Manajemen Jadwal</h3>
            <p>Membuat jadwal dan cek jadwal yang konflik</p>
        </a>
        <a href="{{ route('admin.TambahPelajaran') }}" class="TombolNya" data-aos="fade-up" data-aos-delay="400">
            <div class="IconFA"><i class="fas fa-book"></i></div>
            <h3>Manajemen Pelajaran</h3>
            <p>Menambah pelajaran yang diajar oleh guru</p>
        </a>
        <a href="{{ route('admin.manajemenPost') }}" class="TombolNya" data-aos="fade-up" data-aos-delay="500">
            <div class="IconFA"><i class="fas fa-bullhorn"></i></div>
            <h3>Manajemen Postingan</h3>
            <p>Membuat dan mengatur pengumuman beserta blog</p>
        </a>
    </div>

    <div class="ProfileAdmin">
        <div class="LayoutProfileAdmin">
            <div class="ProfileAvatar">
                @if ($admin->profile && $admin->profile->avatar && file_exists(public_path('storage/file/' . $admin->profile->avatar)))
                    <img src="{{ asset('storage/file/' . $admin->profile->avatar . '?v=' . time()) }}">
                @else
                    <div class="DefaultAvatar">{{ strtoupper(substr($admin->profile->name, 0, 2)) }}</div>
                @endif
            </div>
            <div class="DetailProfile">
                <div class="BagianNamaProfile">
                    <h2>{{ $admin->profile->name }}</h2>
                    <p>Administrator</p>
                </div>
                <div class="EditButtonFlex">
                    <a href="{{ route('postingan.profile.update') }}" class="EditButton">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    });
</script>