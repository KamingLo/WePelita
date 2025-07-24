@include('orangtua.partials.header')
@include('orangtua.partials.sidebar')
<meta name="csrf-token" content="{{ csrf_token() }}">

@php
    $role = session('role');
@endphp
<script>window.role = '{{ $role }}';</script>

<body class="font-sans text-gray-700 m-0 p-0 overflow-x-hidden md:overflow-x-auto">
    <div id="main-content" class="px-4 md:px-8 py-8 flex flex-col gap-8 min-h-screen transition-all duration-400 ease-in-out">
        @php
            $muridKelas = $muridKelas ?? null;
            $kelasName = $muridKelas
                ? "{$muridKelas->kelasTahun->kelas->nama_kelas} ({$muridKelas->kelasTahun->tahunajar->tahun_ajaran})"
                : 'No class assigned';
            $muridName = $muridKelas ? $muridKelas->murid->profile->name : 'No child assigned';
        @endphp

        <h1 class="text-gray-800 mb-2 text-2xl font-bold relative pb-2">
            Parent Dashboard
            <span class="absolute left-0 bottom-0 h-1 w-24 bg-blue-600"></span>
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            <a href="{{ route('orangtua.jadwal') }}"
               class="bg-white p-5 rounded-lg shadow-md text-center text-gray-700 no-underline transition-all duration-300 ease-in-out hover:shadow-lg hover:-translate-y-1" data-aos="fade-up" data-aos-delay="100">
                <div class="text-4xl text-blue-600 mb-4"><i class="fa-solid fa-calendar-days"></i></div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Jadwal Kelas</h3>
                <p class="text-sm text-gray-500">Lihat jadwal kelas murid</p>
            </a>
            <a href="{{ route('orangtua.nilai') }}"
               class="bg-white p-5 rounded-lg shadow-md text-center text-gray-700 no-underline transition-all duration-300 ease-in-out hover:shadow-lg hover:-translate-y-1" data-aos="fade-up" data-aos-delay="200">
                <div class="text-4xl text-blue-600 mb-4"><i class="fa-solid fa-scroll"></i></div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Nilai Murid</h3>
                <p class="text-sm text-gray-500">Periksa nilai murid</p>
            </a>
            <a href="{{ route('orangtua.pengumuman') }}"
               class="bg-white p-5 rounded-lg shadow-md text-center text-gray-700 no-underline transition-all duration-300 ease-in-out hover:shadow-lg hover:-translate-y-1" data-aos="fade-up" data-aos-delay="300">
                <div class="text-4xl text-blue-600 mb-4"><i class="fa-solid fa-bullhorn"></i></div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Pengumuman</h3>
                <p class="text-sm text-gray-500">Lihat semua pengumuman</p>
            </a>
        </div>

        <div class="w-full">
            <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md flex flex-col sm:flex-row items-center gap-4 sm:gap-5" style="width: 30rem; max-width: 100%;" data-aos="fade-up" data-aos-delay="500" data-aos-anchor-placement="top-bottom" data-aos-once="true" data-aos-mirror="false" data-aos-offset="0">
                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden flex items-center justify-center bg-gray-100 border-4 border-gray-200 flex-shrink-0">
                    @if($orangtua->profile && $orangtua->profile->avatar && file_exists(public_path('storage/file/' . $orangtua->profile->avatar)))
                        <img src="{{ asset('storage/file/' . $orangtua->profile->avatar . '?v=' . time()) }}" alt="{{ $orangtua->profile->name }} Avatar" class="w-full h-full object-cover">
                    @else
                        <div class="text-3xl sm:text-4xl font-semibold text-blue-500 uppercase">{{ strtoupper(substr($orangtua->profile->name, 0, 2)) }}</div>
                    @endif
                </div>
                <div class="flex flex-col sm:flex-row justify-between items-center w-full text-center sm:text-left gap-2 sm:gap-0">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-800">{{ $orangtua->profile->name }}</h3>
                        <p class="text-sm text-gray-500">Parent</p>
                        <p class="text-sm text-gray-500">Kelas: {{ $kelasName }}</p>
                    </div>
                    <a href="{{ route('postingan.profile.update') }}" class="flex items-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 text-sm text-white bg-blue-500 border border-blue-500 rounded-md hover:bg-blue-600 hover:border-blue-600 hover:shadow-lg transition-all duration-300">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>

        <div class="w-full">
            <h1 class="text-gray-900 mb-6 text-2xl font-bold relative pb-2" data-aos="fade-up" data-aos-delay="550" data-aos-anchor-placement="top-bottom" data-aos-once="true" data-aos-mirror="false" data-aos-offset="0">
                Pengumuman Terbaru
                <span class="absolute left-0 bottom-0 h-1 w-24 bg-blue-600"></span>
            </h1>
            <div class="py-8 w-full -mt-10" data-aos="fade-up" data-aos-delay="600" data-aos-anchor-placement="top-bottom" data-aos-once="true" data-aos-mirror="false" data-aos-offset="0">
                @if($announcements->isNotEmpty())
                    @php
                        $latestAnnouncement = $announcements->first();
                    @endphp
                    <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col sm:flex-row gap-6 max-w-full w-full" style="min-height: 0; max-width: 600px;">
                        <div class="w-full h-32 sm:w-48 sm:h-48 bg-cover bg-center rounded-lg border border-gray-100 overflow-hidden flex-shrink-0"
                            @if($latestAnnouncement->lampiran)
                                style="background-image: url('{{ asset('storage/' . $latestAnnouncement->lampiran) }}');"
                            @else
                                style="background-image: url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80');"
                            @endif
                        ></div>
                        <div class="flex-1 flex flex-col gap-4 w-full overflow-hidden">
                            <h3 class="text-xl font-semibold text-gray-900 overflow-hidden text-ellipsis whitespace-nowrap max-w-full">{{ $latestAnnouncement->judul }}</h3>
                            <p class="text-sm text-gray-600 overflow-hidden line-clamp-3 max-w-full" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">{{ Str::limit(strip_tags($latestAnnouncement->isi), 150) }}</p>
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mt-auto">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-gray-50 flex items-center justify-center font-medium text-gray-700 border border-gray-200">
                                        {{ $latestAnnouncement->profile ? strtoupper(substr($latestAnnouncement->profile->name, 0, 2)) : '??' }}
                                    </div>
                                    <div class="flex flex-col text-sm">
                                        <span class="font-medium text-gray-800 overflow-hidden text-ellipsis whitespace-nowrap">{{ $latestAnnouncement->profile->name ?? 'Unknown Author' }}</span>
                                        <span class="text-gray-500 text-xs overflow-hidden text-ellipsis whitespace-nowrap">{{ $latestAnnouncement->created_at->format('M d, Y') }}</span>
                                        <span class="text-gray-500 text-xs overflow-hidden text-ellipsis whitespace-nowrap">
                                            Tujuan: {{ $latestAnnouncement->kelasTahun
                                                ? Str::limit("{$latestAnnouncement->kelasTahun->kelas->nama_kelas} - {$latestAnnouncement->kelasTahun->tahunajar->tahun_ajaran}", 30, '...')
                                                : 'Publik' }}
                                        </span>
                                    </div>
                                </div>
                                <a href="#" class="TombolBacaSelengkapnya px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-300 flex-shrink-0" data-id="{{ $latestAnnouncement->postingan_id }}">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-center text-gray-500 text-base p-8 rounded-xl bg-white shadow-sm col-span-full">Tidak ada pengumuman tersedia.</p>
                @endif
            </div>
        </div>

        <div id="announcementPopup" class="popup hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="relative bg-white p-5 rounded-lg shadow-lg w-full max-w-3xl max-h-[90vh] overflow-y-auto mx-auto">
                <div class="flex flex-col gap-5">
                    <div class="blog-image" data-aos="fade-up"></div>
                    <div class="blog-content px-0 sm:px-5" data-aos="fade-up" data-aos-delay="100">
                        <h1 class="popup-title text-2xl text-gray-800 font-semibold mb-3"></h1>
                        <div class="flex flex-wrap gap-5 text-gray-500 text-sm mb-4">
                            <span class="author flex items-center gap-2"><i class='bx bx-user'></i> <span class="popup-author"></span></span>
                            <span class="date flex items-center gap-2"><i class='bx bx-calendar'></i> <span class="popup-date"></span></span>
                        </div>
                        <div class="blog-body text-gray-800 text-base leading-relaxed"></div>
                        <a href="#" class="back-btn flex items-center gap-2 px-4 py-2 text-sm text-white bg-blue-600 border border-blue-600 rounded-md hover:bg-blue-700 hover:border-blue-700 hover:shadow-lg transition-all duration-300 w-fit mt-5">
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
    </div>
</body>