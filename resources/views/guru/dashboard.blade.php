@include('guru.partials.header')
@include('guru.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/Dashboard.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<div class="dashboard-container">
    <h1>Hi, {{ $guru->profile->name }}</h1>

    <div class="dashboard-actions">
        <a href="{{ request()->routeIs('postingan.profile.show') ? 'http://127.0.0.1:8000/' : route('guru.jadwal') }}" class="action-card" data-aos="fade-up" data-aos-delay="100">
            <div class="action-icon"><i class="fas fa-users"></i></div>
            <h3>Liat Jadwal Pelajaran</h3>
            <p>Manage students, teachers, parents, and admins</p>
        </a>
        <a href="{{ request()->routeIs('postingan.profile.show') ? 'http://127.0.0.1:8000/' : route('guru.jadwalanda') }}" class="action-card" data-aos="fade-up" data-aos-delay="200">
            <div class="action-icon"><i class="fas fa-chalkboard"></i></div>
            <h3>Liat Jadwal Ajar Anda</h3>
            <p>Create and manage class assignments</p>
        </a>
        <a href="{{ request()->routeIs('postingan.profile.show') ? 'http://127.0.0.1:8000/' : route('guru.isinilai') }}" class="action-card" data-aos="fade-up" data-aos-delay="300">
            <div class="action-icon"><i class="fas fa-calendar-alt"></i></div>
            <h3>Menu nilai</h3>
            <p>Schedule classes and check for conflicts</p>
        </a>
        <a href="{{ request()->routeIs('postingan.profile.show') ? 'http://127.0.0.1:8000/' : route('guru.ManajemenPost') }}" class="action-card" data-aos="fade-up" data-aos-delay="400">
            <div class="action-icon"><i class="fas fa-book"></i></div>
            <h3>Manajemen postingan</h3>
            <p>Add and update school subjects</p>
        </a>
    </div>

    <div class="profile-section">
        <div class="profile-card">
            <div class="profile-avatar">
                @if($guru->profile && $guru->profile->avatar && file_exists(public_path('storage/file/' . $guru->profile->avatar)))
                    <img src="{{ asset('storage/file/' . $guru->profile->avatar . '?v=' . time()) }}" alt="{{ $guru->profile->name }} Avatar">
                @else
                    <div class="profile-placeholder">{{ strtoupper(substr($guru->profile->name, 0, 2)) }}</div>
                @endif
            </div>
            <div class="profile-details">
                <h2>{{ $guru->profile->name }}</h2>
                <p>Guru</p>
                <a href="{{ route('postingan.profile.update') }}" class="edit-profile-btn">
                    <i class="fas fa-edit"></i> Edit Profile
                </a>
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