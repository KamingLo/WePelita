@include('orangtua.partials.header')
@include('orangtua.partials.sidebar')
<link rel="stylesheet" href="{{ asset('css/OrtuCSS/Pengumuman.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<div class="ContainerPengumuman">
    <div class="LayoutPengumuman">
        <h2>Daftar Pengumuman</h2>
        <div class="LayoutDisplayPostingan">
            @if($announcements->isNotEmpty())
                @foreach($announcements as $announcement)
                    <div class="CardPost">
                        <div class="ImagePostCard"
                            @if($announcement->lampiran)
                                style="background-image: url('{{ asset('storage/' . $announcement->lampiran) }}');"
                            @else
                                style="background-image: url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80');"
                            @endif>
                        </div>
                        <div class="IsiCardPost">
                            <h3 class="JudulCardPost">{{ $announcement->judul }}</h3>
                            <p class="KontenCardPost">{{ Str::limit(strip_tags($announcement->isi), 210) }}</p>
                            <div class="FooterCardPost">
                                <div class="InfoUserCardPost">
                                    <div class="FotoProfileCardPost">
                                        @if($announcement->profile)
                                            {{ strtoupper(substr($announcement->profile->name, 0, 2)) }}
                                        @else
                                            ??
                                        @endif
                                    </div>
                                    <div class="UserProfileCardPost">
                                        <span class="NamaPengunaCP">
                                            @if($announcement->profile)
                                                {{ $announcement->profile->name }}
                                            @else
                                                Unknown Author
                                            @endif
                                        </span>
                                        <span class="TanggalPublikasihCP">{{ $announcement->created_at->format('M d, Y') }}</span>
                                        <span class="TujuanPost">
                                            Tujuan: {{ $announcement->kelasTahun ? $announcement->kelasTahun->kelas->nama_kelas . ' - ' . $announcement->kelasTahun->tahunajar->tahun_ajaran : 'Publik' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="OpsiTombolCp">
                                    <a href="#" class="TombolOJT TombolBacaSelengkapnya" data-id="{{ $announcement->postingan_id }}">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Tidak ada pengumuman tersedia.</p>
            @endif
        </div>
    </div>
</div>

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
<!-- dashboard.blade.php -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        $('.TombolBacaSelengkapnya').on('click', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            console.log('Fetching announcement ID:', id);

            // Dynamically determine the URL based on session role (assumed available via PHP or JS)
            let url = '';
            const role = '{{ session('role') }}'; // Ensure this is passed from the backend
            if (role === 'orangtua') {
                url = `/announcement/orangtua/${id}`;
            } else if (role === 'murid') {
                url = `/announcement/murid/${id}`;
            } else {
                console.error('Unknown role:', role);
                alert('Role not recognized. Please log in again.');
                return;
            }

            $.ajax({
                url: url,
                method: 'GET',
                xhrFields: {
                    withCredentials: true // Include session cookies
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json' // Request JSON response
                },
                success: function(data) {
                    console.log('Data received:', data);
                    $('#announcementPopup .blog-image').html(
                        data.lampiran ? `<img src="{{ asset('storage/') }}/${data.lampiran}" alt="${data.judul}">` : 
                        `<img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="${data.judul}">`
                    );
                    $('#announcementPopup .popup-title').text(data.judul);
                    $('#announcementPopup .popup-author').text(data.profile?.name ?? 'Penulis Tidak Diketahui');
                    $('#announcementPopup .popup-date').text(moment(data.created_at).format('MMM D, YYYY'));
                    $('#announcementPopup .blog-body').html(data.isi);
                    $('#announcementPopup').fadeIn();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                    console.log('Response:', jqXHR.responseText);
                    let response = jqXHR.responseJSON;
                    let errorMessage = response?.error || 'Failed to load announcement. Please try again.';
                    alert(errorMessage);
                }
            });
        });

        $(document).on('click', '.close-btn', function() {
            $('#announcementPopup').fadeOut();
        });

        $(document).on('click', '.back-btn', function(e) {
            e.preventDefault();
            console.log('Kembali button clicked');
            $('#announcementPopup').fadeOut();
        });

        $(window).on('click', function(e) {
            if ($(e.target).is('.popup')) {
                $('#announcementPopup').fadeOut();
            }
        });
    });
</script>