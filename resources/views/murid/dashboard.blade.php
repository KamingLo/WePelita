@include('murid.partials.header')
@include('murid.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/AdminCSS/Dashboard.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<div class="dashboard-container">
    <h1>Hi, {{ $murid->profile->name }}</h1>

    <div class="profile-section">
        <div class="profile-card">
            <div class="profile-avatar">
                @if($murid->profile->foto)
                    <img src="{{ asset('storage/' . $murid->profile->foto) }}" alt="{{ $murid->profile->name }} Avatar">
                @else
                    <div class="profile-placeholder">{{ strtoupper(substr($murid->profile->name, 0, 2)) }}</div>
                @endif
            </div>
            <div class="profile-details">
                <h2>{{ $murid->profile->name }}</h2>
                <p>Administrator</p>
                <a href="" class="edit-profile-btn">
                    <i class="fas fa-edit"></i> Edit Profile
                </a>
            </div>
        </div>
    </div>

    <div class="announcement-section">
        <h2>Announcements</h2>
        @if($announcements->isNotEmpty())
            <div class="announcement-list">
                @foreach($announcements as $announcement)
                    <div class="announcement-card">
                        <div class="announcement-image"
                            @if($announcement->lampiran)
                                style="background-image: url('{{ asset('storage/' . $announcement->lampiran) }}');"
                            @else
                                style="background-image: url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80');"
                            @endif>
                        </div>
                        <div class="announcement-content">
                            <h3>{{ $announcement->judul }}</h3>
                            <p>{{ Str::limit(strip_tags($announcement->isi), 150) }}</p>
                            <div class="announcement-footer">
                                <div class="announcement-author">
                                    <span>By: {{ $announcement->profile->name }}</span>
                                    <span>{{ $announcement->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No announcements available for your class.</p>
        @endif
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