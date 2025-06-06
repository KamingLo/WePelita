@include('murid.partials.header')
@include('murid.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/MuridCSS/Dashboard.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<div class="dashboard-container">
    @php
        $muridKelas = App\Models\MuridKelas::where('murid_id', $murid->murid_id)
            ->whereHas('kelasTahun.tahunajar', function ($query) {
                $query->where('status', 'Aktif');
            })
            ->with('kelasTahun.kelas', 'kelasTahun.tahunajar')
            ->first();
        $kelasName = $muridKelas ? $muridKelas->kelasTahun->kelas->nama_kelas . ' (' . $muridKelas->kelasTahun->tahunajar->tahun_ajaran . ')' : 'No class assigned';
    @endphp
    <div class="HeaderDashboardMurid">
        <h1>Hi, {{ $murid->profile->name }}</h1>
        <h4>Kelas: {{ $kelasName }}</h4>
    </div>

    <div class="dashboard-actions">
        <a href="{{ route('murid.jadwal') }}" class="action-card" data-aos="fade-up" data-aos-delay="100">
            <div class="action-icon"><i class="fas fa-users"></i></div>
            <h3>Jadwal Kelas</h3>
            <p>Manage students, teachers, parents, and admins</p>
        </a>
        <a href="{{ route('murid.nilai') }}" class="action-card" data-aos="fade-up" data-aos-delay="200">
            <div class="action-icon"><i class="fas fa-chalkboard"></i></div>
            <h3>Nilai Murid</h3>
            <p>Create and manage class assignments</p>
        </a>
        <a href="{{ route('murid.pengumuman') }}" class="action-card" data-aos="fade-up" data-aos-delay="300">
            <div class="action-icon"><i class="fas fa-calendar-alt"></i></div>
            <h3>Pengumuman</h3>
            <p>View all announcements</p>
        </a>
    </div>

    <!-- Display student's class -->
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
                <p>Student</p>
                <a href="" class="edit-profile-btn">
                    <i class="fas fa-edit"></i> Edit Profile
                </a>
            </div>
        </div>
    </div>

    <div class="announcement-section">
        <h2>Pengumuman Terbaru</h2>
        <a href="{{ route('murid.pengumuman') }}" class="view-all-btn">Lihat Semua Pengumuman</a>
        <div class="LayoutDisplayPostingan">
            @if($announcements->isNotEmpty())
                @php
                    $latestAnnouncement = $announcements->first();
                @endphp
                <div class="CardPost">
                    <div class="ImagePostCard"
                        @if($latestAnnouncement->lampiran)
                            style="background-image: url('{{ asset('storage/' . $latestAnnouncement->lampiran) }}');"
                        @else
                            style="background-image: url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80');"
                        @endif>
                    </div>
                    <div class="IsiCardPost">
                        <h3 class="JudulCardPost">{{ $latestAnnouncement->judul }}</h3>
                        <p class="KontenCardPost">{{ Str::limit(strip_tags($latestAnnouncement->isi), 210) }}</p>
                        <div class="FooterCardPost">
                            <div class="InfoUserCardPost">
                                <div class="FotoProfileCardPost">
                                    @if($latestAnnouncement->profile)
                                        {{ strtoupper(substr($latestAnnouncement->profile->name, 0, 2)) }}
                                    @else
                                        ??
                                    @endif
                                </div>
                                <div class="UserProfileCardPost">
                                    <span class="NamaPengunaCP">
                                        @if($latestAnnouncement->profile)
                                            {{ $latestAnnouncement->profile->name }}
                                        @else
                                            Unknown Author
                                        @endif
                                    </span>
                                    <span class="TanggalPublikasihCP">{{ $latestAnnouncement->created_at->format('M d, Y') }}</span>
                                    <span class="TujuanPost">
                                        Tujuan: {{ $latestAnnouncement->kelasTahun ? $latestAnnouncement->kelasTahun->kelas->nama_kelas . ' - ' . $latestAnnouncement->kelasTahun->tahunajar->tahun_ajaran : 'Publik' }}
                                    </span>
                                </div>
                            </div>
                            <div class="OpsiTombolCp">
                                <a href="#" class="TombolOJT TombolBacaSelengkapnya" data-id="{{ $latestAnnouncement->postingan_id }}">
                                    <i class="fas fa-eye"></i> Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p>Tidak ada pengumuman tersedia.</p>
            @endif
        </div>
    </div>
</div>

<!-- Pop-out for full announcement -->
<div id="announcementPopup" class="popup" style="display: none;">
    <div class="popup-content">
        <span class="close-btn">&times;</span>
        <div class="blog-detail-container">
            <div class="blog-image" data-aos="fade-up"></div>
            <div class="blog-content" data-aos="fade-up" data-aos-delay="100">
                <h1 class="popup-title"></h1>
                <div class="blog-meta">
                    <span class="author"><i class='bx bx-user'></i> <span class="popup-author"></span></span>
                    <span class="date"><i class='bx bx-calendar'></i> <span class="popup-date"></span></span>
                </div>
                <div class="blog-body"></div>
                <a href="#" class="back-btn" data-aos="fade-up" data-aos-delay="200">
                    <i class='bx bx-arrow-back'></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        // Handle "Baca Selengkapnya" click
        $('.TombolBacaSelengkapnya').on('click', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            console.log('Fetching announcement ID:', id); // Debug
            $.get(`/announcement/${id}`, function(data) {
                console.log('Data received:', data); // Debug
                $('#announcementPopup .blog-image').html(
                    data.lampiran ? `<img src="{{ asset('storage/') }}/${data.lampiran}" alt="${data.judul}">` : 
                    `<img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="${data.judul}">`
                );
                $('#announcementPopup .popup-title').text(data.judul);
                $('#announcementPopup .popup-author').text(data.profile?.name ?? 'Penulis Tidak Diketahui');
                $('#announcementPopup .popup-date').text(moment(data.created_at).format('MMM D, YYYY'));
                $('#announcementPopup .blog-body').html(data.isi);
                $('#announcementPopup').fadeIn();
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX error:', textStatus, errorThrown); // Debug
                alert('Failed to load announcement. Please try again.');
            });
        });

        // Close popup with "close-btn"
        $(document).on('click', '.close-btn', function() {
            $('#announcementPopup').fadeOut();
        });

        // Close popup with "Kembali" button
        $(document).on('click', '.back-btn', function(e) {
            e.preventDefault();
            console.log('Kembali button clicked'); // Debug
            $('#announcementPopup').fadeOut();
        });

        // Close popup when clicking outside
        $(window).on('click', function(e) {
            if ($(e.target).is('.popup')) {
                $('#announcementPopup').fadeOut();
            }
        });
    });
</script>