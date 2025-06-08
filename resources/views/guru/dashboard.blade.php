@include('guru.partials.header')
@include('guru.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/GuruCSS/Dashboard.css') }}" />

<div class="ContainerDashboard">
    <h1>Hi, {{ $guru->profile->name }}</h1>

    <div class="ShotcutSidebar">
        <a href="{{ request()->routeIs('postingan.profile.show') ? 'http://127.0.0.1:8000/' : route('guru.jadwal') }}" 
            class="TombolNya" data-aos="fade-up" data-aos-delay="100">
            <div class="IconFA"><i class="fas fa-users"></i></div>
            <h3>Liat Jadwal Pelajaran</h3>
            <p>Manage students, teachers, parents, and admins</p>
        </a>
        <a href="{{ request()->routeIs('postingan.profile.show') ? 'http://127.0.0.1:8000/' : route('guru.jadwalanda') }}" 
            class="TombolNya" data-aos="fade-up" data-aos-delay="200">
            <div class="IconFA"><i class="fas fa-chalkboard"></i></div>
            <h3>Liat Jadwal Ajar Anda</h3>
            <p>Create and manage class assignments</p>
        </a>
        <a href="{{ request()->routeIs('postingan.profile.show') ? 'http://127.0.0.1:8000/' : route('guru.isinilai') }}" 
            class="TombolNya" data-aos="fade-up" data-aos-delay="300">
            <div class="IconFA"><i class="fas fa-calendar-alt"></i></div>
            <h3>Menu Nilai</h3>
            <p>Schedule classes and check for conflicts</p>
        </a>
        <a href="{{ request()->routeIs('postingan.profile.show') ? 'http://127.0.0.1:8000/' : route('guru.ManajemenPost') }}" 
            class="TombolNya" data-aos="fade-up" data-aos-delay="400">
            <div class="IconFA"><i class="fas fa-book"></i></div>
            <h3>Manajemen Postingan</h3>
            <p>Add and update school subjects</p>
        </a>
    </div>

    <div class="ProfileAdmin">
        <div class="LayoutProfileAdmin">
            <div class="ProfileAvatar">
                @if($guru->profile && $guru->profile->avatar && file_exists(public_path('storage/file/' . $guru->profile->avatar)))
                    <img src="{{ asset('storage/file/' . $guru->profile->avatar . '?v=' . time()) }}" alt="{{ $guru->profile->name }} Avatar">
                @else
                    <div class="DefaultAvatar">{{ strtoupper(substr($guru->profile->name, 0, 2)) }}</div>
                @endif
            </div>
            <div class="DetailProfile">
                <div class="BagianNamaProfile">
                    <h2>{{ $guru->profile->name }}</h2>
                    <p>Guru</p>
                </div>
                <div class="EditButtonFlex">
                    <a href="{{ route('postingan.profile.update') }}" class="EditButton EditButtonFlex">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    });
</script>