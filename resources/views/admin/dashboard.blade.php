@include('admin.partials.header', ['NamaPage' => 'Halaman Utama'])
@include('admin.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/Dashboard.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<div class="dashboard-container">
    <h1>Hi, {{ $admin->profile->name }}</h1>

    <div class="dashboard-actions">
        <a href="{{ route('admin.ManajemenUser') }}" class="action-card" data-aos="fade-up" data-aos-delay="100">
            <div class="action-icon"><i class="fas fa-users"></i></div>
            <h3>Manage Users</h3>
            <p>Manage students, teachers, parents, and admins</p>
        </a>
        <a href="{{ route('admin.manajemenKelas') }}" class="action-card" data-aos="fade-up" data-aos-delay="200">
            <div class="action-icon"><i class="fas fa-chalkboard"></i></div>
            <h3>Manage Classes</h3>
            <p>Create and manage class assignments</p>
        </a>
        <a href="{{ route('admin.TambahJadwal') }}" class="action-card" data-aos="fade-up" data-aos-delay="300">
            <div class="action-icon"><i class="fas fa-calendar-alt"></i></div>
            <h3>Manage Schedules</h3>
            <p>Schedule classes and check for conflicts</p>
        </a>
        <a href="{{ route('admin.TambahPelajaran') }}" class="action-card" data-aos="fade-up" data-aos-delay="400">
            <div class="action-icon"><i class="fas fa-book"></i></div>
            <h3>Manage Subjects</h3>
            <p>Add and update school subjects</p>
        </a>
        <a href="{{ route('admin.manajemenPost') }}" class="action-card" data-aos="fade-up" data-aos-delay="500">
            <div class="action-icon"><i class="fas fa-bullhorn"></i></div>
            <h3>Manage Posts</h3>
            <p>Create and manage announcements and blogs</p>
        </a>
    </div>

    <div class="profile-section">
        <div class="profile-card">
            <div class="profile-avatar">
                @if($admin->profile->foto)
                    <img src="{{ asset('storage/' . $admin->profile->foto) }}" alt="{{ $admin->profile->name }} Avatar">
                @else
                    <div class="profile-placeholder">{{ strtoupper(substr($admin->profile->name, 0, 2)) }}</div>
                @endif
            </div>
            <div class="profile-details">
                <h2>{{ $admin->profile->name }}</h2>
                <p>Administrator</p>
                    <a href="" class="edit-profile-btn">
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