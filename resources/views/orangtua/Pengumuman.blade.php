@include('orangtua.partials.header')
@include('orangtua.partials.sidebar')

<body class="font-sans text-gray-700 m-0 p-0 overflow-x-hidden md:overflow-x-auto">
    <div id="main-content" class="px-4 md:px-8 py-8 flex flex-col gap-8 min-h-screen transition-all duration-400 ease-in-out">
        <h4 class="w-full text-gray-800 mb-2 text-2xl font-bold relative pb-2 md:mt-0">
            Daftar Pengumuman
            <span class="absolute left-0 bottom-0 h-1 w-24 bg-blue-600"></span>
        </h4>

        <div class="w-full">
            @if($announcements->isNotEmpty())
                <div class="flex flex-col gap-6">
                    @foreach($announcements as $announcement)
                        <div class="bg-white border border-gray-100 rounded-xl p-6 sm:p-8 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col sm:flex-row gap-6 max-w-full w-full" style="max-width: 700px;">
                            <div class="w-full h-32 sm:w-48 sm:h-48 bg-cover bg-center rounded-lg border border-gray-100 overflow-hidden flex-shrink-0"
                                @if($announcement->lampiran)
                                    style="background-image: url('{{ asset('storage/' . $announcement->lampiran) }}');"
                                @else
                                    style="background-image: url('https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80');"
                                @endif
                            ></div>
                            <div class="flex-1 flex flex-col gap-4 w-full overflow-hidden">
                                <h3 class="text-xl font-semibold text-gray-900 overflow-hidden text-ellipsis whitespace-nowrap max-w-full">{{ $announcement->judul }}</h3>
                                <p class="text-sm text-gray-600 overflow-hidden line-clamp-3 max-w-full" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">{{ Str::limit(strip_tags($announcement->isi), 150) }}</p>
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mt-auto">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-gray-50 flex items-center justify-center font-medium text-gray-700 border border-gray-200">
                                            {{ $announcement->profile ? strtoupper(substr($announcement->profile->name, 0, 2)) : '??' }}
                                        </div>
                                        <div class="flex flex-col text-sm">
                                            <span class="font-medium text-gray-800 overflow-hidden text-ellipsis whitespace-nowrap">{{ $announcement->profile->name ?? 'Unknown Author' }}</span>
                                            <span class="text-gray-500 text-xs overflow-hidden text-ellipsis whitespace-nowrap">{{ $announcement->created_at->format('M d, Y') }}</span>
                                            <span class="text-gray-500 text-xs overflow-hidden text-ellipsis whitespace-nowrap">
                                                Tujuan: {{ $announcement->kelasTahun
                                                    ? Str::limit("{$announcement->kelasTahun->kelas->nama_kelas} - {$announcement->kelasTahun->tahunajar->tahun_ajaran}", 30, '...')
                                                    : 'Publik' }}
                                            </span>
                                        </div>
                                    </div>
                                    <a href="#" class="TombolBacaSelengkapnya px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-300 flex-shrink-0" data-id="{{ $announcement->postingan_id }}">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white border border-gray-100 rounded-xl p-6 sm:p-8 shadow-sm text-center text-gray-500 text-base">
                    Tidak ada pengumuman tersedia.
                </div>
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

            $('.TombolBacaSelengkapnya').on('click', function(e) {
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
                if ($(e.target).is('#announcementPopup')) {
                    $('#announcementPopup').fadeOut();
                }
            });
        });
    </script>
</body>