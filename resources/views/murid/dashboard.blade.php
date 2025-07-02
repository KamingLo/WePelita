@include('murid.partials.header')
@include('murid.partials.sidebar')
<meta name="csrf-token" content="{{ csrf_token() }}">

@php
    $role = session('role');
@endphp
<script>window.role = '{{ $role }}';</script>

<div class="ml-0 lg:ml-64 p-4 sm:p-4 flex flex-col gap-4 sm:gap-8 transform translate-y-0 sm:translate-y-0 min-h-screen pt-5">
    @php
        $muridKelas = App\Models\MuridKelas::where('murid_id', $murid->murid_id)
            ->whereHas('kelasTahun.tahunajar', fn($query) => $query->where('status', 'Aktif'))
            ->with('kelasTahun.kelas', 'kelasTahun.tahunajar')
            ->first();
        $kelasName = $muridKelas
            ? "{$muridKelas->kelasTahun->kelas->nama_kelas} ({$muridKelas->kelasTahun->tahunajar->tahun_ajaran})"
            : 'No class assigned';
    @endphp

    <div class="flex flex-col sm:flex-row gap-4 sm:gap-8">
        <h2 class="text-gray-800 text-xl sm:text-2xl font-semibold relative pb-2 sm:pb-3 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:sm:h-1 after:w-full sm:after:w-24 after:bg-blue-500">
            Student Dashboard
        </h2>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
        <a href="{{ request()->routeIs('postingan.profile.show') ? 'http://127.0.0.1:8000/' : route('murid.jadwal') }}" class="bg-white p-4 sm:p-5 rounded-lg shadow-md text-center text-gray-800 hover:-translate-y-1 hover:shadow-lg transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
            <div class="text-3xl sm:text-4xl text-blue-500 mb-3 sm:mb-4"><i class="fa-solid fa-calendar-days"></i></div>
            <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-1 sm:mb-2">Jadwal Kelas</h3>
            <p class="text-xs sm:text-sm text-gray-500">Lihat jadwal kelas anda</p>
        </a>
        <a href="{{ request()->routeIs('postingan.profile.show') ? 'http://127.0.0.1:8000/' : route('murid.nilai') }}" class="bg-white p-4 sm:p-5 rounded-lg shadow-md text-center text-gray-800 hover:-translate-y-1 hover:shadow-lg transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
            <div class="text-3xl sm:text-4xl text-blue-500 mb-3 sm:mb-4"><i class="fa-solid fa-scroll"></i></div>
            <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-1 sm:mb-2">Nilai Murid</h3>
            <p class="text-xs sm:text-sm text-gray-500">Periksa nilai murid</p>
        </a>
        <a href="{{ request()->routeIs('postingan.profile.show') ? 'http://127.0.0.1:8000/' : route('murid.pengumuman') }}" class="bg-white p-4 sm:p-5 rounded-lg shadow-md text-center text-gray-800 hover:-translate-y-1 hover:shadow-lg transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
            <div class="text-3xl sm:text-4xl text-blue-500 mb-3 sm:mb-4"><i class="fa-solid fa-bullhorn"></i></div>
            <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-1 sm:mb-2">Pengumuman</h3>
            <p class="text-xs sm:text-sm text-gray-500">Lihat semua pengumuman</p>
        </a>
    </div>

    <div class="w-full">
        <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md flex flex-col sm:flex-row items-center gap-4 sm:gap-5" style="width: 30rem; max-width: 100%;">
            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden flex items-center justify-center bg-gray-100 border-4 border-gray-200 flex-shrink-0">
                @if($murid->profile && $murid->profile->avatar && file_exists(public_path('storage/file/' . $murid->profile->avatar)))
                    <img src="{{ asset('storage/file/' . $murid->profile->avatar . '?v=' . time()) }}" alt="{{ $murid->profile->name }} Avatar" class="w-full h-full object-cover">
                @else
                    <div class="text-3xl sm:text-4xl font-semibold text-blue-500 uppercase">{{ strtoupper(substr($murid->profile->name, 0, 2)) }}</div>
                @endif
            </div>
            <div class="flex flex-col sm:flex-row justify-between items-center w-full text-center sm:text-left gap-2 sm:gap-0">
                <div>
                    <h3 class="text-base sm:text-lg font-semibold text-gray-800">{{ $murid->profile->name }}</h3>
                    <p class="text-sm text-gray-500">Student</p>
                    <p class="text-sm text-gray-500">Kelas: {{ $kelasName }}</p>
                </div>
                <a href="{{ route('postingan.profile.update') }}" class="flex items-center gap-2 px-3 py-1.5 sm:px-she-4 sm:py-2 text-sm text-white bg-blue-500 border border-blue-500 rounded-md hover:bg-blue-600 hover:border-blue-600 hover:shadow-lg transition-all duration-300">
                    <i class="fas fa-edit"></i> Edit Profile
                </a>
            </div>
        </div>
    </div>

    <div class="w-full">
        <h2 class="text-gray-800 text-xl sm:text-2xl font-semibold relative pb-2 sm:pb-3 after:content-[''] after:absolute after:left-0 after:bottom-0 after:h-0.5 after:sm:h-1 after:w-full sm:after:w-24 after:bg-blue-500">
            Pengumuman Terbaru
        </h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-5 py-3 rounded-xl">
            @if($announcements->isNotEmpty())
                @php
                    $latestAnnouncement = $announcements->first();
                @endphp
                <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 flex flex-col sm:flex-row gap-4 sm:gap-5 min-h-[180px] sm:min-h-[200px]">
                    <div class="w-full h-40 sm:w-48 sm:h-48 bg-cover bg-center rounded-lg border border-gray-200 flex-shrink-0"
                        @if($latestAnnouncement->lampiran)
                            style="background-image: url('{{ asset('storage/' . $latestAnnouncement->lampiran) }}');"
                        @else
                            style="background-image: url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80');"
                        @endif
                    ></div>
                    <div class="flex-1 flex flex-col gap-2 sm:gap-3 w-full">
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-900">{{ $latestAnnouncement->judul }}</h3>
                        <a class="text-sm text-gray-600 overflow-hidden min-h-[5rem] sm:min-h-[7rem]">{{ Str::limit(strip_tags($latestAnnouncement->isi), 300) }}</a>
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mt-auto">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gray-100 flex items-center justify-center font-semibold text-gray-800 text-sm sm:text-base border-2 border-gray-200">
                                    {{ $latestAnnouncement->profile ? strtoupper(substr($latestAnnouncement->profile->name, 0, 2)) : '??' }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-semibold text-gray-800 text-xs sm:text-sm">{{ $latestAnnouncement->profile->name ?? 'Unknown Author' }}</span>
                                    <span class="text-gray-500 text-xs sm:text-sm">{{ $latestAnnouncement->created_at->format('M d, Y') }}</span>
                                    <span class="text-gray-500 text-xs sm:text-sm">
                                        Tujuan: {{ $latestAnnouncement->kelasTahun
                                            ? "{$latestAnnouncement->kelasTahun->kelas->nama_kelas} - {$latestAnnouncement->kelasTahun->tahunajar->tahun_ajaran}"
                                            : 'Publik' }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <a href="#" class="TombolBacaSelengkapnya px-3 py-1.5 sm:px-4 sm:py-2 text-sm text-white bg-blue-500 border border-blue-500 rounded-md hover:bg-blue-600 hover:border-blue-600 hover:shadow-lg transition-all duration-300" data-id="{{ $latestAnnouncement->postingan_id }}">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-left text-gray-500 text-sm sm:text-base p-6 sm:p-10 rounded-lg min-h-[5rem] col-span-full">Tidak ada pengumuman tersedia.</p>
            @endif
        </div>
    </div>
</div>

<div id="announcementPopup" class="popup hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="relative bg-white p-4 sm:p-5 rounded-lg shadow-lg w-full max-w-xl sm:max-w-3xl max-h-[90vh] overflow-y-auto mx-auto">
        <div class="flex flex-col gap-4 sm:gap-5">
            <div class="blog-image" data-aos="fade-up"></div>
            <div class="blog-content px-0 sm:px-5" data-aos="fade-up" data-aos-delay="100">
                <h1 class="popup-title text-xl sm:text-2xl text-gray-800 font-semibold mb-2 sm:mb-3"></h1>
                <div class="flex flex-wrap gap-2 sm:gap-5 text-gray-500 text-xs sm:text-sm mb-3 sm:mb-4">
                    <span class="author flex items-center gap-1 sm:gap-2"><i class='bx bx-user'></i> <span class="popup-author"></span></span>
                    <span class="date flex items-center gap-1 sm:gap-2"><i class='bx bx-calendar'></i> <span class="popup-date"></span></span>
                </div>
                <div class="blog-body text-gray-800 text-sm sm:text-base leading-relaxed"></div>
                <a href="#" class="back-btn flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 text-sm text-white bg-blue-500 border border-blue-500 rounded-md hover:bg-blue-600 hover:border-blue-600 hover:shadow-lg transition-all duration-300 w-fit mt-4 sm:mt-5">
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

        $(document).on('click', '.TombolBacaSelengkapnya', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            console.log('Fetching announcement ID:', id);

            let url = '';
            const role = '{{ session('role') }}';
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
                    withCredentials: true
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                },
                success: function(data) {
                    console.log('Data received:', data);
                    $('#announcementPopup .blog-image').html(
                        data.lampiran ? `<img src="{{ asset('storage/') }}/${data.lampiran}" alt="${data.judul}" class="w-full h-auto rounded-lg object-cover">` :
                        `<img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="${data.judul}" class="w-full h-auto rounded-lg object-cover">`
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